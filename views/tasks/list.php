<?php
require_once ROOT . "/views/layout/header.php";

if (isset($message) && !empty($message)) { ?>
    <div class="alert alert-success" role="alert">
        <?=$message?>
    </div>
<?php } ?>

<div class="row">
    <div class="col-8 offset-2">
        <h3 class="text-center">Task list</h3>

        <a href="tasks/create" class="fr">
            <button type="button" class="btn btn-success pull-right m-t-15">Create new task</button>
        </a>
        <br>
        <table id="tasks_table" class="table table-striped table-bordered">
            <thead>
            <tr>
                <th>User name</th>
                <th>Email</th>
                <th>Task</th>
                <th>Status</th>
                <th>Modified status</th>
                <?php if (isset($_SESSION['user']) && $_SESSION['user']) { ?>
                    <th>Edit</th>
                    <?php
                }else{
                    ?>
                    <th style="display: none"></th>
                    <?php
                } ?>
            </tr>
            </thead>
            <tbody>
            <?php if (isset($tasks) && $tasks) {
                foreach ($tasks as $task) { ?>
                    <tr>
                        <td><?= $task['username'] ?></td>
                        <td><?= $task['email'] ?></td>
                        <td><?= $task['task'] ?></td>
                        <td><?= $status_arr[$task['status']] ?></td>
                        <td><?= $modified_arr[$task['is_modified']] ?></td>
                        <?php if (isset($_SESSION['user']) && $_SESSION['user']) { ?>
                            <td><a href="/mvc_project/task/edit/<?=$task['guid']?>"><i class="fa fa-pencil"></i></a></td>
                            <?php
                        }else{
                            ?>
                            <td style="display: none"></td>
                            <?php
                        } ?>
                    </tr>
                    <?php
                }
            } ?>
            </tbody>
        </table>

    </div>
</div>

<script>
    $(document).ready(function () {
        $('#tasks_table').DataTable({
            "pageLength": 3,
            "columnDefs": [
                { "orderable": false, "targets": 5 }
            ]
        });
        $('.custom-select').prepend('<option value="3">3</option>');
    });
</script>
<?php require_once ROOT . "/views/layout/footer.php"; ?>
