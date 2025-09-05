<?php
namespace app\controllers\Admin;
use app\models\Voucher;
class VoucherController {
    private $voucherModel;
    private $conn;

    public function __construct($db) {
         if (session_status() === PHP_SESSION_NONE) {
        session_start();
        }
        if (!isset($_SESSION['is_admin']) || $_SESSION['is_admin'] !== true) {
            header("Location: /coffee/login");
            exit();
        }
        $this->voucherModel = new Voucher($db);
    }

    public function index() {
        $list = $this->voucherModel->getAll();
        require_once ROOT_PATH . '/app/views/admin/voucher/index.php';
    }
    public function create() {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $ma = $_POST['ma'] ?? '';
        $phan_tram_giam = $_POST['phan_tram_giam'] ?? 0;
        $giam_toi_da = $_POST['giam_toi_da'] ?? 0;
        $ngay_bat_dau = $_POST['ngay_bat_dau'] ?? null;
        $ngay_ket_thuc = $_POST['ngay_ket_thuc'] ?? null;
        $so_luong = $_POST['so_luong'] ?? 0;
        $da_su_dung = 0; 
        $trang_thai = 1; 
        $dieukien = $_POST['dieukien'] ?? '';

        $this->voucherModel->create(
            $ma, $phan_tram_giam, $giam_toi_da, $ngay_bat_dau, $ngay_ket_thuc,
            $so_luong, $da_su_dung, $trang_thai, $dieukien
        );

        header("Location: /coffee/admin/voucher/index");
        exit();
    }
    require_once ROOT_PATH . '/app/views/admin/voucher/create.php';
}


    public function edit($id) {
        $voucher = $this->voucherModel->getById($id);
        if (!$voucher) {
            echo "Mã giảm giá không tồn tại";
            exit;
        }
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'] ?? $voucher['id'];
            $ma = $_POST['ma'] ?? '';
            $phan_tram_giam = $_POST['phan_tram_giam'] ?? 0;
            $ngay_bat_dau = $_POST['ngay_bat_dau'] ?? null;
            $ngay_ket_thuc = $_POST['ngay_ket_thuc'] ?? null;
            $so_luong = $_POST['so_luong'] ?? 0;
            $dieukien = $_POST['dieukien'] ?? '';
            $this->voucherModel->update(
            $id,
            $ma,
            $phan_tram_giam,
            $voucher['giam_toi_da'],   
            $ngay_bat_dau,
            $ngay_ket_thuc,
            $so_luong,
            $voucher['da_su_dung'],   
            $voucher['trang_thai'],    
            $dieukien
        );
            header("Location: /coffee/admin/voucher/index");
            exit();
        }
        require_once ROOT_PATH . '/app/views/admin/voucher/edit.php';
    }

    public function delete($id) {
        $this->voucherModel->delete($id);
        header("Location: /coffee/admin/voucher/index");
        exit();
    }
}
