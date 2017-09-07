<?php
namespace App\Http\Controllers;

/**
 * Created by PhpStorm.
 * User: wangqihang
 * Date: 17/4/23
 * Time: 8:51
 */
use DB;
use Excel;
use App\Http\Requests;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
class TestController extends Controller
{
    public function index(){
        //return "hello laravle5.4";
        /*$code = 'asdfj';
        $theme = "";
        $time = time();
        $insert = DB::table('course')->insert(
            [
                'nam'=>'uname',
                'code'=>$code,
                'cover'=>$theme,
                'create_time'=>$time,
                'create_id'=>'10',
            ]
        );
        return $insert;*/
        return date('Y-m-d H:i:s');
        //return phpinfo();
    }
    /**
        二维码
    */
    public function qrcode()
    {
        QrCode::format('png')->size(300)->margin(0)->generate('Hello,LaravelAcademy!',public_path('/img/code/qrcode.png'));
        return view('test');
    }
    /**
        将pdf的首页转换成图片格式
    */
    public function testpdf(){
         $fileName1 = 'CZ2016-01-01/o_1ak57jr6ms741efo1ndk8b4daic.jpg';
         $path1 = "http://img.qkhl.net/test";
         chmod($path1.'/'.$fileName1, '-rwxrwxrwx' );//赋给文件权限(777)
         $data_i =  $this->pdf2png($fileName1, $path1);
         die('{"status" s: "success", "result": {"imgpath" : "' . $data_i . '"}}');//返回参数

    }
    function pdf2png($pdf,$path1,$page=-1){
    
         if(!extension_loaded('imagick')){
         
             return 4;
         }
         if(!file_exists($pdf)){
         
             return 5;
         }
         $im = new Imagick();
         $im->setResolution(60,60); //设置分辨率
         $im->setCompressionQuality(10);//设置图片压缩的质量
         if($page==-1)  {
          $ss =   $im->readImage($pdf);
         }
         else{
            $im->readImage($pdf."[".$page."]");//从文件名读取图像
             return 7;
         }
         $im->setImageFormat('jpg'); //为图片设置指定的格式
         $filename1 = $path1."/". md5(time()).'.jpg';
         $dd = $im->writeImage($filename1);
         // return '阻住';
         if($dd == true){     //把图片写入指定的文件
         
            // return 'yes';
             $return = $filename1;
         } else{
              return '失败';
         }
         return $return;
  }
  public function transaction()
  {
    DB::beginTransaction();
    try {
        $user1 = DB::table('user')->insert(['uname'=>'user1','password'=>'111']);
        $user2 = DB::table('user')->insert(['uname'=>'user2','password'=>'222222222222222']);
        if($user1&&$user2){
            DB::commit();
            echo 'success';
        }
    } catch (\Exception $e) {
        DB::rollBack();
        echo 'error';
    }
    
    //echo $user1.'---------'.$user2;
  }
  public function excel()
  {
      $cellData = [
          ['学号','姓名','成绩'],
          ['10001','AAAAA','99'],
          ['10002','BBBBB','92'],
          ['10003','CCCCC','95'],
          ['10004','DDDDD','89'],
          ['10005','EEEEE','96'],
      ];

      Excel::create('学生成绩',function($excel) use ($cellData){
          $excel->sheet('scoresheet', function($sheet) use ($cellData){
              $sheet->rows($cellData);
          });
      })->export('xls');
  }
}