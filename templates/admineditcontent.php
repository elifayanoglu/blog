<?php

/**
 * @var $model \app\model\ContentForm
 */

use app\controller\CategoryController;
use app\controller\ContentController;
use app\core\form\Form;
use app\core\Application;
use app\core\form\ImageField;
use app\core\form\Select;
use app\core\form\SelectField;
use app\core\form\SummernoteField;

$categoryController = new CategoryController();
$contentController = new ContentController();
$thePost = $contentController->getContent(['title' => $_GET['title']]);

?>

<?php $form = Form::begin('', 'post') ?>
<?php echo $form->field($model, 'title') ?>
<?php echo new SummernoteField($model, 'content') ?>
<?php echo new ImageField($model, 'image') ?>

<form method="post" action="" enctype="multipart/form-data">
    <input type="text" class="au-input au-input--full form-control" value="<?php echo $thePost['title']?>">
</form>



<label>Category</label>
<?php Select::begin() ?>
<option disabled hidden>Category</option>
<?php foreach ($categoryController->getCategories() as $category) : ?>
    <option value="<?php echo $category['name'] ?>"><?php echo $category['name'] ?></option>
<?php endforeach; ?>
<?php Select::end() ?>
<button class="au-btn au-btn--block au-btn--green m-b-20" type="submit" name="submit">upload</button>
<?php Form::end()  ?>

<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>

<script>
    $('#summernote').summernote({
        placeholder: 'Hello stand alone ui',
        tabsize: 2,
        height: 120,
        toolbar: [
            ['style', ['style']],
            ['font', ['bold', 'underline', 'clear']],
            ['color', ['color']],
            ['para', ['ul', 'ol', 'paragraph']],
            ['table', ['table']],
            ['insert', ['link', 'picture', 'video']],
            ['view', ['fullscreen', 'codeview', 'help']]
        ]
    });
</script>