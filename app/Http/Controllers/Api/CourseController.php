<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Course;
use App\Http\Resources;
use App\Http\Resources\CourseResource;

class CourseController extends Controller
{
    public function index()
    {
        $courses = Course::get();
       
        return CourseResource::collection($courses);
    }
}
