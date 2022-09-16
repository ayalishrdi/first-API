<?php

require_once "koneksi.php";

if(function_exists($_GET['function'])){
    $_GET['function']();
}

function getCoba(){

    global $koneksi;
    $query = mysqli_query($koneksi, "SELECT * FROM coba");
    while($data = mysqli_fetch_object($query)){
        $coba[] = $data;
    }

    $respon = array(
        'status'   =>1,
        'message'  => 'success get coba',
        'coba'    => $coba
    );

    header('Content-Type: application/json');
    print json_encode($respon);

}

function addCoba(){
    

    global $koneksi;

    $kira = array(
        'merk'  => '',
        'jenis' => ''
    );

    $periksa = count(array_intersect_key($_POST, $kira));

    if($periksa == count($kira)){
        $merk   = $_POST['merk'];
        $jenis  = $_POST['jenis'];
        
        $result = mysqli_query($koneksi, "INSERT INTO coba VALUES('', '$merk', '$jenis')");

            if($result){
                $respon = array(
                    'status'    =>1,
                    'message'   => 'Pesanan baru berhasil masuk'
                );
            }else{
                $respon = array(
                    'status'    =>0,
                    'message'   => 'Gagal memesan'
                );
            }
        }else{
            $respon = array(
                'status'    =>0,
                'message'   => 'kode pemesanan salah'
            
            );
        }
    header('Content-Type: application/json');
    print json_encode($respon);

    }
    
    function message($status, $message){
        $respon = array(
            'status' => $status,
            'message' => $message
        );

        header('Content-Type: application/json');
        print json_encode($respon);
    
    }

function updateCoba(){
        global $koneksi;

        if(!empty($_GET['id'])){
            $id = $_GET ['id'];
        }

        $kira = array(
            'merk'  =>  "",
            'jenis' =>  ""

        );

        $periksa = count(array_intersect_key($_POST, $kira));

        if ($periksa == count($kira)){

            $merk   = $_POST['merk'];
            $jenis  = $_POST['jenis'];

            $result = mysqli_query($koneksi, "UPDATE coba SET merk='$merk', jenis='$jenis' WHERE  id='$id'");
            if($result){
                return message(1, "Update data $merk success");
            }else{
                return message(0, "Update data failed");
            }
        }else{
            return message(0, "parameter salah");
        }
    }

   function deleteCoba(){

    global $koneksi;

    if(!empty($_GET['id'])){
        $id = $_GET['id'];
    }

    $result = mysqli_query($koneksi, "DELETE FROM coba WHERE id='$id'");

    if ($result){
        return message(1, "delete data success");
    }else{
        return message(0, "delete data failed");
    }
   } 
   function detailCobaId(){

    global $koneksi;

    if(!empty($_GET['id'])){
        $id = $_GET['id'];
    }

    $result = $koneksi-> query("SELECT * FROM coba WHERE id='$id'");

    while($data = mysqli_fetch_object($result)){
        $detailCoba[] = $data;
    }

    if($detailCoba){
        $respon = array(
            'status'    => 1,
            'message'   => "Nih datanya",
            'user'      => $detailCoba
        );
    }else{
        return message (0, "detail data tidak bisa muncul");
    }

    header('content-Type:application/json');
    print json_encode($respon);
   }

?>