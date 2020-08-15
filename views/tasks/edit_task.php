<?php require_once ROOT . "/views/layout/header.php"; ?>

<div class="row p-t-15">
    <div class="col-6 offset-3">
        <h3 class="text-center">Edit task</h3>
        <form action="update_task" method="post">
            <div class="form-group">
                <label for="username">Username*</label>
                <input type="text" class="form-control" name="username" id="username" placeholder="Username" readonly
                       value="<?= $task_row['username'] ?>">
                <input type="hidden" class="form-control" name="guid" id="guid" value="<?= $guid ?>">
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Email address*</label>
                <input type="email" name="email" class="form-control" id="exampleInputEmail1"
                       aria-describedby="emailHelp"
                       placeholder="Enter email" readonly value="<?= $task_row['email'] ?>">
                <small id="emailHelp" class="form-text text-muted err_mes">Please type valid email address</small>
            </div>

            <div class="form-group">
                <label for="task">Task*</label>
                <textarea class="form-control" name="task" id="task" placeholder="Task here"
                          required><?= $task_row['task'] ?></textarea>
            </div>

            <div class="form-group">
                <label for="status">Is success</label><br>
                <input type="checkbox" name="status" id="status"
                       readonly <?php if($task_row['status']== 1){ echo 'checked'; }?>>
            </div>

            <button type="submit" name="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
</div>

<?php require_once ROOT . "/views/layout/footer.php"; ?>
