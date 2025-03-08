<?php

namespace App\Controllers;

class HomeController extends Controller
{
  public function __construct()
  {
    if (!session('user')) {
      return redirect('/login');
    }
  }

  public function index()
  {
    if (!session('user')) {
      return redirect('/login');
    }
    return redirect('/profile');
  }

  public function profile()
  {
    return view('home.profile');
  }

  public function courses()
  {
    return view('home.courses');
  }

  public function courseDetail($id)
  {
    $courseContent = [
      'Buổi 1: Hiểu vể bản chất việc học tiếng Anh' => [
        'duration' => '90 mins',
        'details' => [
          'Ôn tập nội dung bài cũ + Sửa Homework',
          'Nghe bài nghe thuộc chủ đề Education, cho học viên ôn lại vocab đã học',
          'Ôn tập lại kiến thức về Noun đã học (loại từ, vị trí từ,...)',
          'Tổng kết nội dung bài học + giao Homework',
          'Tổng hợp vocabs đã học trong topic Education theo mental models giáo viên gợi ý',
        ],
      ],
      'Buổi 2: Cách học từ vựng hiệu quả - Tích luỹ từ vựng chủ đề Education' => [
        'duration' => '90 mins',
        'details' => [
          'Ôn tập nội dung bài cũ + Sửa Homework',
          'Nghe bài nghe thuộc chủ đề Education, cho học viên ôn lại vocab đã học',
          'Ôn tập lại kiến thức về Noun đã học (loại từ, vị trí từ,...)',
          'Tổng kết nội dung bài học + giao Homework',
          'Tổng hợp vocabs đã học trong topic Education theo mental models giáo viên gợi ý',
        ],
      ],
      'Buổi 3: Làm quen với Danh từ (Noun) - Phân tích vị trí và các dạng thức của Danh Từ' => [
        'duration' => '90 mins',
        'details' => [
          'Ôn tập nội dung bài cũ + Sửa Homework',
          'Nghe bài nghe thuộc chủ đề Education, cho học viên ôn lại vocab đã học',
          'Ôn tập lại kiến thức về Noun đã học (loại từ, vị trí từ,...)',
          'Tổng kết nội dung bài học + giao Homework',
          'Tổng hợp vocabs đã học trong topic Education theo mental models giáo viên gợi ý',
        ],
      ],
      'Buổi 4: Ôn tập về Danh từ (vị trí - các dạng thức - chức năng)' => [
        'duration' => '90 mins',
        'details' => [
          'Ôn tập nội dung bài cũ + Sửa Homework',
          'Nghe bài nghe thuộc chủ đề Education, cho học viên ôn lại vocab đã học',
          'Ôn tập lại kiến thức về Noun đã học (loại từ, vị trí từ,...)',
          'Tổng kết nội dung bài học + giao Homework',
          'Tổng hợp vocabs đã học trong topic Education theo mental models giáo viên gợi ý',
        ],
      ],
      'Buổi 5: Làm quen với Động từ (Verb) và Verb patterns - Học từ vựng chủ đề Hobbies và Interest' => [
        'duration' => '90 mins',
        'details' => [
          'Ôn tập nội dung bài cũ + Sửa Homework',
          'Nghe bài nghe thuộc chủ đề Education, cho học viên ôn lại vocab đã học',
          'Ôn tập lại kiến thức về Noun đã học (loại từ, vị trí từ,...)',
          'Tổng kết nội dung bài học + giao Homework',
          'Tổng hợp vocabs đã học trong topic Education theo mental models giáo viên gợi ý',
        ],
      ],
      'Buổi 6: Phân tích vị trí và các dạng thức của Động Từ - Học từ vựng chủ đề Travel' => [
        'duration' => '90 mins',
        'details' => [
          'Ôn tập nội dung bài cũ + Sửa Homework',
          'Nghe bài nghe thuộc chủ đề Education, cho học viên ôn lại vocab đã học',
          'Ôn tập lại kiến thức về Noun đã học (loại từ, vị trí từ,...)',
          'Tổng kết nội dung bài học + giao Homework',
          'Tổng hợp vocabs đã học trong topic Education theo mental models giáo viên gợi ý',
        ],
      ],
      'Buổi 7: Ôn tập về Động từ (vị trí - các dạng thức)' => [
        'duration' => '90 mins',
        'details' => [
          'Ôn tập nội dung bài cũ + Sửa Homework',
          'Nghe bài nghe thuộc chủ đề Education, cho học viên ôn lại vocab đã học',
          'Ôn tập lại kiến thức về Noun đã học (loại từ, vị trí từ,...)',
          'Tổng kết nội dung bài học + giao Homework',
          'Tổng hợp vocabs đã học trong topic Education theo mental models giáo viên gợi ý',
        ],
      ],
    ];
    return view('courses.detail', compact('courseContent'));
  }

  public function exercise()
  {
    return view('home.exercise');
  }

  public function homework()
  {
    return view('exercises.homework');
  }

  public function test()
  {
    return view('exercises.test');
  }
}
