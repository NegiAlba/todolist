<form class="row gy-2 gx-3 align-items-center" action="index_post.php" method="POST">
    <div class="col-auto">
        <label class="visually-hidden" for="autoSizingInput">Task</label>
        <input type="text" class="form-control" name="task" id="autoSizingInput" placeholder="Title of your task">
    </div>
    <div class="col-auto">
        <label class="visually-hidden" for="autoSizingInput2">Description</label>
        <input type="text" class="form-control" name="description" id="autoSizingInput2"
            placeholder="Description for task">
    </div>
    <div class="col-auto">
        <label class="visually-hidden" for="autoSizingSelect">Status</label>
        <select class="form-select" id="autoSizingSelect" name="status">
            <!-- Afficher ici mes status de manière dynamique -->
            <option value='' selected>How is it going ?</option>
            <?php
                foreach ($selectStatusData as $data) {
                    echo "<option value='{$data['status_id']}'>{$data['label']}</option>";
                } ?>
        </select>
    </div>
    <div class="col-auto">
        <input type="datetime-local" name="deadline" id="dateInput">
    </div>
    <div class="col-auto">
        <button type="submit" class="btn btn-primary">+</button>
    </div>
</form>
<div class="tasks">
    <div class="container">
        <table class="table table-dark table-striped">
            <thead>
                <tr>
                    <th scope="col"> ID#</th>
                    <th scope="col"> Task</th>
                    <th scope="col"> Description</th>
                    <th scope="col"> Status</th>
                    <th scope="col"> Deadline</th>
                    <th scope="col"> Edit</th>
                    <th scope="col"> Delete</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    foreach ($displayTasksData as $task) {
                        ?>
                            <tr>
                                <form action="todolist_post.php" method="post">
                                    <th scope="row" class="lead"><input name="task_id" class="form-control-plaintext text-white" type="text" value="<?php echo $task['task_id']; ?>" readonly></th>
                                    <td><input type="text" name="title" id="" class="form-control" value="<?php echo $task['title']; ?>"></td>
                                    <td><input type="text" name="description" id="" class="form-control" value="<?php echo $task['description']; ?>"></td>
                                    <td>
                                        <select class="form-select" id="autoSizingSelect" name="status">
                                            <!-- Afficher ici mes status de manière dynamique -->
                                            <!-- <option value="<?php echo $task['status_id']; ?>" selected>-- Current : <?php echo $task['label']; ?>--</option> -->
                                            <?php
                                                foreach ($selectStatusData as $data) {
                                                ?>
                                                    <option value="<?= $data['status_id']; ?>" <?= $data['status_id'] === $task['status_id'] ? 'selected' : '' ?> >
                                                        <?=$data['label'];?>
                                                    </option>
                                                <?php
                                            } ?>
                                        </select>
                                    </td>
                                    <td>
                                        <input type="datetime-local" name="deadline" id="" class="form-control" value="<?php echo date('Y-m-d\TH:i:s', strtotime($task['deadline'])) ?>">
                                    </td>
                                    <td><button type="submit" class="btn btn-warning" name="edit_post"><i class="fas fa-pen"></i></button></td>
                                </form>
                            </tr>
                        <?php
                    }
                ?>
            </tbody>
        </table>
    </div>
</div>