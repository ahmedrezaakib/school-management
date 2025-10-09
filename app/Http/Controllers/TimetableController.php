<?php

namespace App\Http\Controllers;

use App\Models\Period;
use App\Models\Classes;
use App\Models\Subject;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;

class TimetableController extends Controller
{
    // Show class selection + quick view
    public function index()
    {
        $classes = Classes::orderBy('name')->get();
        return view('timetable.index', compact('classes'));
    }

    // Weekly grid for a given class
    public function showByClass($classId)
    {
        $class = Classes::findOrFail($classId);

        $periods = Period::with(['subject', 'teacher'])
            ->where('class_id', $classId)
            ->orderBy('day_of_week')
            ->orderBy('start_time')
            ->get()
            ->groupBy('day_of_week');

        $days = [0 => 'Sun', 1 => 'Mon', 2 => 'Tue', 3 => 'Wed', 4 => 'Thu', 5 => 'Fri', 6 => 'Sat'];

        return view('timetable.show', compact('class', 'periods', 'days'));
    }

    public function create(Request $request)
    {
        $classes = Classes::orderBy('name')->get();
        $subjects = Subject::orderBy('name')->get();
        // Only show teachers
        $teachers = User::where('role', 'teacher')->orderBy('name')->get();

        $days = [0 => 'Sun', 1 => 'Mon', 2 => 'Tue', 3 => 'Wed', 4 => 'Thu', 5 => 'Fri', 6 => 'Sat'];

        return view('timetable.form', [
            'mode' => 'create',
            'period' => new Period(),
            'classes' => $classes,
            'subjects' => $subjects,
            'teachers' => $teachers,
            'days' => $days,
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'class_id' => ['required', 'exists:classes,id'],
            'subject_id' => ['required', 'exists:subjects,id'],
            // FIX: validate against users table & ensure role=teacher
            'teacher_id' => [
                'required',
                Rule::exists('users', 'id')->where(fn($q) => $q->where('role', 'teacher')),
            ],
            'day_of_week' => ['required', 'integer', 'between:0,6'],
            'start_time' => ['required', 'date_format:H:i'],
            'end_time' => ['required', 'date_format:H:i', 'after:start_time'],
            'room' => ['nullable', 'string', 'max:100'],
            'academic_year_id' => ['nullable', 'exists:academic_years,id'],
        ]);

        // --- Business validations ---

        // 1) Subject must be assigned to class
        $subjectAssigned = DB::table('assign_subjects')
            ->where('class_id', $data['class_id'])
            ->where('subject_id', $data['subject_id'])
            ->exists();

        if (!$subjectAssigned) {
            return back()->withInput()->withErrors([
                'subject_id' => 'This subject is not assigned to the selected class.',
            ]);
        }

        // 2) Teacher must be assigned to class + subject
        $teacherAssigned = DB::table('assign_teacher_to_classes')
            ->where('class_id', $data['class_id'])
            ->where('subject_id', $data['subject_id'])
            ->where('teacher_id', $data['teacher_id'])
            ->exists();

        if (!$teacherAssigned) {
            return back()->withInput()->withErrors([
                'teacher_id' => 'This teacher is not assigned to teach this subject in the selected class.',
            ]);
        }

        // 3) No overlap in class timetable
        $overlapClass = Period::where('class_id', $data['class_id'])
            ->where('day_of_week', $data['day_of_week'])
            ->where(function ($q) use ($data) {
                $q->where('start_time', '<', $data['end_time'])
                    ->where('end_time', '>', $data['start_time']);
            })
            ->exists();

        if ($overlapClass) {
            return back()->withInput()->withErrors([
                'start_time' => 'Time overlaps with another period for this class on that day.',
            ]);
        }

        // 4) No double-booking for teacher
        $overlapTeacher = Period::where('teacher_id', $data['teacher_id'])
            ->where('day_of_week', $data['day_of_week'])
            ->where(function ($q) use ($data) {
                $q->where('start_time', '<', $data['end_time'])
                    ->where('end_time', '>', $data['start_time']);
            })
            ->exists();

        if ($overlapTeacher) {
            return back()->withInput()->withErrors([
                'teacher_id' => 'Teacher is already assigned to another period at this time.',
            ]);
        }

        Period::create($data);

        return redirect()
            ->route('timetable.class', $data['class_id'])
            ->with('success', 'Period added.');
    }



    public function edit(Period $period)
    {
        $classes = Classes::orderBy('name')->get();
        $subjects = Subject::orderBy('name')->get();
        $teachers = User::where('role', 'teacher')->orderBy('name')->get();

        $days = [0 => 'Sun', 1 => 'Mon', 2 => 'Tue', 3 => 'Wed', 4 => 'Thu', 5 => 'Fri', 6 => 'Sat'];

        return view('timetable.form', [
            'mode' => 'edit',
            'period' => $period,
            'classes' => $classes,
            'subjects' => $subjects,
            'teachers' => $teachers,
            'days' => $days,
        ]);
    }

    public function update(Request $request, Period $period)
    {
        $data = $request->validate([
            'class_id' => ['required', 'exists:classes,id'],
            'subject_id' => ['required', 'exists:subjects,id'],
            // FIX: users table + role constraint
            'teacher_id' => [
                'required',
                Rule::exists('users', 'id')->where(fn($q) => $q->where('role', 'teacher')),
            ],
            'day_of_week' => ['required', 'integer', 'between:0,6'],
            'start_time' => ['required', 'date_format:H:i'],
            'end_time' => ['required', 'date_format:H:i', 'after:start_time'],
            'room' => ['nullable', 'string', 'max:100'],
            'academic_year_id' => ['nullable', 'exists:academic_years,id'],
        ]);

        // Repeat the same validations but exclude the current period in overlap checks
        $subjectAssigned = DB::table('assign_subjects')
            ->where('class_id', $data['class_id'])
            ->where('subject_id', $data['subject_id'])
            ->exists();

        if (!$subjectAssigned) {
            return back()->withInput()->withErrors([
                'subject_id' => 'This subject is not assigned to the selected class.',
            ]);
        }

        $teacherAssigned = DB::table('assign_teacher_to_classes')
            ->where('class_id', $data['class_id'])
            ->where('subject_id', $data['subject_id'])
            ->where('teacher_id', $data['teacher_id'])
            ->exists();

        if (!$teacherAssigned) {
            return back()->withInput()->withErrors([
                'teacher_id' => 'This teacher is not assigned to teach this subject in the selected class.',
            ]);
        }

        $overlapClass = Period::where('class_id', $data['class_id'])
            ->where('day_of_week', $data['day_of_week'])
            ->where('id', '<>', $period->id)
            ->where(function ($q) use ($data) {
                $q->where('start_time', '<', $data['end_time'])
                    ->where('end_time', '>', $data['start_time']);
            })
            ->exists();

        if ($overlapClass) {
            return back()->withInput()->withErrors([
                'start_time' => 'Time overlaps with another period for this class on that day.',
            ]);
        }

        $overlapTeacher = Period::where('teacher_id', $data['teacher_id'])
            ->where('day_of_week', $data['day_of_week'])
            ->where('id', '<>', $period->id)
            ->where(function ($q) use ($data) {
                $q->where('start_time', '<', $data['end_time'])
                    ->where('end_time', '>', $data['start_time']);
            })
            ->exists();

        if ($overlapTeacher) {
            return back()->withInput()->withErrors([
                'teacher_id' => 'Teacher is already assigned to another period at this time.',
            ]);
        }

        $period->update($data);

        return redirect()
            ->route('timetable.class', $data['class_id'])
            ->with('success', 'Period updated.');
    }

    public function destroy(Period $period)
    {
        $classId = $period->class_id;
        $period->delete();

        return redirect()
            ->route('timetable.class', $classId)
            ->with('success', 'Period deleted.');
    }

    // public function myTeacherClasses()
    // {
    //     $teacherId = Auth::id();

    //     // classes the teacher is assigned to (distinct)
    //     $classes = DB::table('assign_teacher_to_classes as atc')
    //         ->join('classes as c', 'c.id', '=', 'atc.class_id')
    //         ->where('atc.teacher_id', $teacherId)
    //         ->select('c.id', 'c.name')
    //         ->distinct()
    //         ->orderBy('c.name')
    //         ->get();

    //     return view('timetable.teacher-classes', compact('classes'));
    // }

    /**
     * TEACHER: show timetable for a class ONLY if this teacher is assigned to that class
     */
    // public function teacherClassTimetable($classId)
    // {
    //     $teacherId = Auth::id();

    //     $allowed = DB::table('assign_teacher_to_classes')
    //         ->where('class_id', $classId)
    //         ->where('teacher_id', $teacherId)
    //         ->exists();

    //     if (!$allowed)
    //         abort(403, 'You are not assigned to this class.');

    //     $class = \App\Models\Classes::findOrFail($classId);
    //     $periods = \App\Models\Period::with(['subject', 'teacher'])
    //         ->forClass($classId)
    //         ->weekOrdered()
    //         ->get()
    //         ->groupBy('day_of_week');

    //     $days = [0 => 'Sun', 1 => 'Mon', 2 => 'Tue', 3 => 'Wed', 4 => 'Thu', 5 => 'Fri', 6 => 'Sat'];

    //     // reuse the same grid view you already have
    //     return view('timetable.show', compact('class', 'periods', 'days'));
    // }
    public function myTeacherClasses()
    {
        $teacher = Auth::user() ?: Auth::guard('teacher')->user();
        if (!$teacher)
            abort(401);
        $teacherId = $teacher->id;

        $classes = DB::table('assign_teacher_to_classes as atc')
            ->join('classes as c', 'c.id', '=', 'atc.class_id')
            ->where('atc.teacher_id', $teacherId)
            ->select('c.id', 'c.name')
            ->distinct()
            ->orderBy('c.name')
            ->get();

        return view('teacher.timetable.classes', compact('classes'));
    }

    public function teacherClassTimetable($classId)
    {
        $teacher = Auth::user() ?: Auth::guard('teacher')->user();
        if (!$teacher)
            abort(401);
        $teacherId = $teacher->id;

        $allowed = DB::table('assign_teacher_to_classes')
            ->where('class_id', $classId)
            ->where('teacher_id', $teacherId)
            ->exists();

        if (!$allowed)
            abort(403, 'You are not assigned to this class.');

        $class = \App\Models\classes::findOrFail($classId);

        $periods = \App\Models\Period::with(['subject', 'teacher'])
            ->where('class_id', $classId)
            ->orderBy('day_of_week')
            ->orderBy('start_time')
            ->get()
            ->groupBy('day_of_week');

        $days = [0 => 'Sun', 1 => 'Mon', 2 => 'Tue', 3 => 'Wed', 4 => 'Thu', 5 => 'Fri', 6 => 'Sat'];

        return view('teacher.timetable.show', compact('class','periods','days'));
    }

    /**
     * STUDENT: show the student's own class timetable
     */
    public function myStudentTimetable()
    {
        $user = Auth::user();
        if (!$user || $user->role !== 'student' || !$user->class_id) {
            abort(403, 'No class found for this student.');
        }

        $classId = $user->class_id;
        $class = Classes::findOrFail($classId);
        $periods = Period::with(['subject', 'teacher'])
            ->forClass($classId)
            ->weekOrdered()
            ->get()
            ->groupBy('day_of_week');

        $days = [0 => 'Sun', 1 => 'Mon', 2 => 'Tue', 3 => 'Wed', 4 => 'Thu', 5 => 'Fri', 6 => 'Sat'];

        // You can show with a student layout; for speed, reuse the same grid
        return view('student.timetable.show', compact('class', 'periods', 'days'));
    }

}
