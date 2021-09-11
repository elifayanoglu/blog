<?php

use app\controller\MemberController;

$memberController = new MemberController();
$this->title = "Admin Members";
?>


<!-- DATA TABLE -->
<h3 class="title-5 m-b-35" style="padding-top: 1rem;">members</h3>
<div class="table-data__tool">
    <div class="table-data__tool-right">
        <button class="au-btn au-btn-icon au-btn--green au-btn--small">
            <i class="zmdi zmdi-plus"></i><a href="/cms/admin/members/add-member" style="color: white; text-decoration: none;">add member</a></button>
    </div>
</div>
<div class="table-responsive table-responsive-data2">
    <table class="table table-data2">
        <thead>
            <tr>
                <th>id</th>
                <th>name</th>
                <th>email</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($memberController->getMembers() as $key => $value) : ?>
                <tr class="tr-shadow">
                    <td id="idRow"><?= $value['id'] ?></td>
                    <td><?= $value['username'] ?></td>
                    <td>
                        <span class="block-email"><?= $value['email'] ?></span>
                    </td>
                    <td>
                        <div class="table-data-feature">
                            <button class="item" data-toggle="tooltip" data-placement="top" title="Send" id="send" type="button">
                                <i class="zmdi zmdi-mail-send" id="send"></i>
                            </button>
                            <button class="item" data-toggle="tooltip" data-placement="top" title="Edit" id="edit" type="button">
                                <i class="zmdi zmdi-edit" id="edit"></i>
                            </button>
                            <button class="item" data-toggle="tooltip" data-placement="top" title="Delete" id="delete" type="button">
                                <i class="zmdi zmdi-delete" id="delete"></i>
                            </button>
                        </div>
                    </td>
                </tr>
                <tr class="spacer"></tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
<!-- END DATA TABLE -->

<script>
    let member = document.getElementsByClassName("tr-shadow");

    function memberClicked(e) {
        if (e.target.id === "delete") {
            console.log("delete clicked");
            let id = $(this).closest("tr").find("td[id='idRow']").html();
            if (confirm(`Do you want to delete member which id : ${id}`)) {
                $.get('members', {
                    'id': id
                });
                window.location.reload();
                // instead reload we can remove the row
            }
        }
        if (e.target.id === "edit") {
            console.log("edit clicked");
        }
        if (e.target.id === "send") {
            console.log("send clicked");
        }
    }

    for (let i = 0; i < member.length; i++) {
        member[i].addEventListener("click", memberClicked);
    }
</script>

<?php
if (isset($_GET['id'])) {
    $memberController->deleteMember(['id' => $_GET['id']]);
}
?>