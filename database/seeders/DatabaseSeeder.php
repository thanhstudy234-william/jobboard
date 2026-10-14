<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Company;
use App\Models\JobPost;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Tài khoản mẫu (mật khẩu chung: 12345678)
        User::create(['name' => 'Admin', 'email' => 'admin@test.com',
            'password' => Hash::make('12345678'), 'role' => 'admin']);

        $employers = [];
        foreach ([1, 2] as $i) {
            $u = User::create(['name' => "Nhà tuyển dụng $i", 'email' => "employer$i@test.com",
                'password' => Hash::make('12345678'), 'role' => 'employer']);
            $employers[] = Company::create([
                'user_id' => $u->id,
                'name' => "Công ty Demo $i",
                'address' => 'Hà Nội',
                'description' => "Mô tả công ty demo $i",
                'size' => '50-100 nhân viên',
            ]);
        }

        foreach ([1, 2, 3] as $i) {
            User::create(['name' => "Ứng viên $i", 'email' => "candidate$i@test.com",
                'password' => Hash::make('12345678'), 'role' => 'candidate']);
        }

        $cats = [];
        foreach (['CNTT', 'Kinh doanh', 'Marketing', 'Kế toán', 'Thiết kế', 'Nhân sự'] as $name) {
            $cats[] = Category::create(['name' => $name, 'slug' => Str::slug($name)]);
        }

        $locations = ['Hà Nội', 'TP. Hồ Chí Minh', 'Đà Nẵng'];
        for ($i = 1; $i <= 10; $i++) {
            JobPost::create([
                'company_id' => $employers[$i % 2]->id,
                'category_id' => $cats[$i % 6]->id,
                'title' => "Vị trí tuyển dụng số $i",
                'description' => 'Mô tả công việc chi tiết cho vị trí này.',
                'requirements' => 'Yêu cầu kinh nghiệm và kỹ năng.',
                'salary_min' => 8000000 + $i * 1000000,
                'salary_max' => 15000000 + $i * 1000000,
                'location' => $locations[$i % 3],
                'job_type' => ['full-time', 'part-time', 'remote'][$i % 3],
                'deadline' => now()->addDays(30),
                'status' => 'approved',
            ]);
        }
    }
}