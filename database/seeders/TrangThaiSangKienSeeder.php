<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TrangThaiSangKienSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //insert 10 fixed data for trang_thai_sang_kien
        DB::table('trang_thai_sang_kien')->insert([
            [
                'ma_trang_thai' => 'Draft',
                'ten_trang_thai' => 'Bản nháp',
                'mo_ta' => 'Sáng kiến sau khi tạo mới sẽ ở trạng thái bản nháp.',
                'order' => 1,
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'ma_trang_thai' => 'Pending',
                'ten_trang_thai' => 'Chờ duyệt',
                'mo_ta' => 'Sáng kiến sau khi bấm nút "Gửi duyệt" sẽ ở trạng thái chờ duyệt, phải chờ trưởng phòng duyệt.',
                'order' => 2,
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'ma_trang_thai' => 'Rejected',
                'ten_trang_thai' => 'Từ chối',
                'mo_ta' => 'Sáng kiến không đủ điều kiện sẽ ở trạng thái từ chối.',
                'order' => 3,
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'ma_trang_thai' => 'Checking',
                'ten_trang_thai' => 'Đang kiểm tra',
                'mo_ta' => 'Sáng kiến sau khi được duyệt bởi trưởng phòng sẽ ở trạng thái kiểm tra, phải chờ thư ký kiểm tra.',
                'order' => 4,
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'ma_trang_thai' => 'Reviewing',
                'ten_trang_thai' => 'Đang thẩm định',
                'mo_ta' => 'Sáng kiến sau khi được kiểm tra bởi thư ký sẽ ở trạng thái đang thẩm định, phải chờ hội đồng duyệt.',
                'order' => 5,
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'ma_trang_thai' => 'Scoring1',
                'ten_trang_thai' => 'Đang chấm điểm vòng 1',
                'mo_ta' => 'Sáng kiến sau khi được duyệt bởi hội đồng sẽ ở trạng thái đang chấm điểm vòng 1, phải chờ từng thành viên hội đồng chấm điểm.',
                'order' => 6,
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'ma_trang_thai' => 'Scoring2',
                'ten_trang_thai' => 'Đang chấm điểm vòng 2',
                'mo_ta' => 'Sáng kiến sau khi được chấm điểm vòng 1 sẽ ở trạng thái đang chấm điểm vòng 2, cả hội đồng thống nhất điểm quyết định.',
                'order' => 7,
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'ma_trang_thai' => 'Approved',
                'ten_trang_thai' => 'Đã duyệt',
                'mo_ta' => 'Sáng kiến đã được duyệt và chấm điểm xong.',
                'order' => 8,
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
