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
                </tr>
            </thead>
            <tbody>
                <?php
                    foreach ($displayTasksData as $task) {
                        ?>
                            <tr>
                                <th scope="row"><?php echo $task['task_id']; ?></th>
                                <td><?php echo $task['title']; ?></td>
                                <td><?php echo $task['description']; ?></td>
                                <td><?php echo $task['label']; ?></td>
                                <td><?php echo $task['deadline']; ?></td>
                            </tr>
                        <?php
                    }
                ?>
            </tbody>
        </table>
    </div>
</div>