<?=$this->layout('layouts/admin') ?>
<?php
$this->title = "Admin Contents";

use app\controller\ContentController;
use app\core\Application;

$contentController = new ContentController();
?>
<div style="display: flex; justify-content:flex-start; padding: 1rem;">
    <h1 class="display-6">Contents</h1>
</div>
<h1><?php /*print_r($_FILES)*/ ?></h1>
<?php if (Application::$app->session->getFlash('success')) : ?>
    <div class="alert alert-success" role="alert">
        <h4 class="alert-heading">Uploaded!</h4>
        <p><?php echo Application::$app->session->getFlash('success') ?></p>
    </div>
<?php endif; ?>
<!-- <div>
    <a href="/cms/admin/contents/new">New Content</a>
</div> -->
<!-- <form action="/cms/admin/contents/new">
    <input type="submit" value="New Content" />
</form> -->
<div style="display: flex; justify-content: flex-start; padding-left: 1rem;">
    <button onclick="location.href='/cms2/admin/contents/new'" type="button" class="btn btn-dark">New Content</button>
</div>

<?php ?>
<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="row">
                
                <?php foreach ($contents as $value) : ?>
        
                    <div class="col-md-4">
                        <div class="card">
                            <img class="card-img-top" src="<?php echo PUBLIC_PATH ?>/uploads/<?php echo $value['image']?>" alt="Card image cap">
                            <div class="card-body">
                                <h4 class="card-title mb-3"><a href="" style="text-decoration: none; color: black;" id="title"><?php echo $value['title']?></a></h4>
                                <label class="switch switch-3d switch-primary mr-3">
                                    <input type="checkbox" id="switch" class="switch-input" <?php if($value['active'] == true){echo "checked";} ?>>
                                    <span class="switch-label"></span>
                                    <span class="switch-handle"></span>
                                </label>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</div>

<script>
    let switch3d = document.getElementsByClassName("switch-3d");
    function switchToggle(e) {
        if (e.target.id === "switch") {
            console.log("switch clicked");
            let title = $(this).closest("div").find("a[id='title']").html();
            let isActive = e.target.checked;
            if(isActive){
                isActive = 1;
            }
            else{
                isActive = 0;
            }
            console.log(isActive);
            if (confirm(`Do you want to delete content which title : ${title}`)) {
                $.get('contents', {
                    'title': title,
                    'isActive': isActive
                });
            }
        }
    }
    for (let i = 0; i < switch3d.length; i++) {
        switch3d[i].addEventListener("click", switchToggle);
    }
</script>

<?php
if (isset($_GET['title'])) {
    $contentController->updateActive(['title' => $_GET['title']], $_GET['isActive']);
}
?>