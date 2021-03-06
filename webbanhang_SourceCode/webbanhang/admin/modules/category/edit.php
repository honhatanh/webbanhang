<?php 
$open = "category";
    require_once __DIR__. "/../../autoload/autoload.php";
    $id = intval(getInput('id'));
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $data=
        [
            "name" => postInput('name'),
            "slug" => to_slug(postInput("name"))
        ];
        $error =[];
        if (postInput('name') == '') {
            # code...
            $error['name'] = "Mời bạn nhập đầy đủ tên danh mục";
        }

        //error trống có nghĩa là không có lỗi
        if(empty($error)){

            if($EditCategory['name'] != $data['name']){
                $isset = $db->fetchOne("category","name = '".$data['name']."' ");
                if(count($isset)>0){
                    $_SESSION['error'] = "Tên danh mục đã tồn tại";
                }else{
                    $id_update = $db->update("category",$data,array("id"=>$id));
                    if($id_update > 0){
                        $_SESSION['success']="Cập nhật thành công";
                        redirectAdmin("category");
                    }else{
            //thêm thất bại
                        $_SESSION['error']="Dữ liệu không thay đổi";
                        redirectAdmin("category");
                    }
                }
            }else{
                $id_update = $db->update("category",$data,array("id"=>$id));
                if($id_update > 0){
                    $_SESSION['success']="Cập nhật thành công";
                    redirectAdmin("category");
                }else{
            //thêm thất bại
                    $_SESSION['error']="Dữ liệu không thay đổi";
                    redirectAdmin("category");
                }
            }

        }
    }

    $EditCategory = $db->fetchID("category",$id);
    if(empty($EditCategory)){
        $_SESSION['error']="Dữ liệu không tồn tại";
        redirectAdmin("category");
    }
?>
<?php 
    require_once __DIR__. "/../../layouts/header.php";
?>
<!-- Page Heading Nội dung -->
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">
            Sửa danh mục
        </h1>
        <ol class="breadcrumb">
            <li>
                <i class="fa fa-dashboard"></i>  <a href="index.html">Dashboard</a>
            </li>
            <li class="active">
                <i></i> <a href="index.php">Danh mục</a>
            </li>
            <li>
                <i class="fa fa-file"></i>  Sửa
            </li>
        </ol>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <form class="form-horizontal" action="" method="POST">
            <div class="form-group row">
                <label for="inputEmail3" class="col-sm-2 control-label">Tên danh mục</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" id="inputEmail3" placeholder="" name="name" value="<?php echo $EditCategory['name'] ?>">
                    <!--Thông báo lỗi-->
                   <?php  require_once __DIR__. "/../../../partials/notification.php"; ?>
                </div>
            </div>
            
            <!-- <div class="form-group row">
                <div class="col-sm-2">Checkbox</div>
                <div class="col-sm-10">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="gridCheck1">
                        <label class="form-check-label" for="gridCheck1">
                            Example checkbox
                        </label>
                    </div>
                </div>
            </div> -->
            <div class="form-group row">
                <div class="col-sm-offset-2 col-sm-10">
                    <button type="submit" class="btn btn-success">Lưu</button>
                </div>
            </div>
        </form>
    </div>
</div>
<!-- /.row -->
<?php 
require_once __DIR__. "/../../layouts/footer.php";
?>