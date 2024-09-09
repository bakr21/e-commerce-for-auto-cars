<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;


class AdminController extends Controller
{
        public function dashboard()
        {
                return view('admin.index');
        }
        public function profilepage()
        {
                return view('admin.profile');
        }
        public function getSlug(Request $request)
        {
                // تأكد من وجود عنوان الاسم في الطلب
                if ($request->has('title')) {
                // إنشاء الـ slug بناءً على العنوان باستخدام Str::slug
                $slug = Str::slug($request->input('title'));

                // رجوع الرد بنجاح مع الـ slug
                return response()->json([
                        'status' => true,
                        'slug' => $slug
                ]);
                }

                // في حالة عدم وجود عنوان الاسم، رجوع الرد بالفشل
                return response()->json([
                'status' => false,
                'slug' => null
                ]);
        }

}
