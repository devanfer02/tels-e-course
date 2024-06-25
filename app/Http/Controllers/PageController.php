<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Services\UserService;
use App\Http\Services\AdminRecordService;
use App\Http\Services\EvaluationService;
use App\Http\Services\Service;
use App\Models\Course;

class PageController extends Controller
{
    private $userService;
    private $evalService;
    private $genericService;

    public function __construct()
    {
        $this->userService = new UserService;
        $this->genericService = new Service;
        $this->evalService = new EvaluationService;
    }

    public function home()
    {
        $pageTitle = 'Home';

        return view('pages.client.home.index', compact('pageTitle'));
    }

    public function index()
    {
        $pageTitle = 'Dashboard';
        $details = $this->genericService->getAppData();

        return view('dashboard', compact('pageTitle', 'details'));
    }

    public function login()
    {
        $pageTitle = 'Login Admin';

        return view('pages.auth.login', compact('pageTitle'));
    }

    public function userLogin()
    {
        return view('pages.client.auth.login');
    }

    public function userRegister()
    {
        return view('pages.client.auth.register');
    }

    public function myCourse()
    {
        return view('pages.client.course.my');
    }

    public function notfound()
    {
        return view('pages.client.notfound.404');
    }

    public function users()
    {
        $pageTitle = 'List Pengguna';
        $users = $this->userService->getUsersByRole('User');

        return view('pages.users.list', compact('pageTitle', 'users'));
    }

    public function records()
    {
        $pageTitle = 'Record Admin';
        $records = AdminRecordService::getRecords();

        return view('pages.log.list', compact('pageTitle', 'records'));
    }

    public function courses()
    {
        $pageTitle = 'List Mata Pelajaran';

        return view('pages.courses.list', compact('pageTitle'));
    }

    public function exams()

    {
        $pageTitle = 'List Ujian Materi';

        return view('pages.evaluations.list', compact('pageTitle'));
    }

    public function enrolls()

    {
        $pageTitle = 'List Enroll Mata Pelajaran';

        return view('pages.enrolls.list', compact('pageTitle'));
    }

    public function createCourse()
    {
        $pageTitle = 'Tambah Mata Pelajaran';

        return view('pages.courses.create', compact('pageTitle'));
    }

    public function createSubcourse(Course $course)
    {
        $pageTitle = 'Tambah Materi Mata Pelajaran';

        return view('pages.subcourses.create', compact('pageTitle', 'course'));
    }

    public function redirect()
    {
        // return view('pages.temp.maintanence');
        return redirect(route('dashboard'));
    }

    public function back()
    {
        return redirect(route('dashboard'));
    }
}
