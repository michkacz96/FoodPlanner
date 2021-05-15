<?php
    require_once 'includes/header.php';
?>
<main class="position-relative overflow-hidden p-3 p-md-5 m-md-3 text-center bg-light">
    <div class="text-left">
        <h2><?php echo $user->username ?> - my info</h2>
    </div>

    <div class="row mt-5">
        <div class="col-6 text-left">
            <?php
            if(isset($_GET['infoError'])){
                if($_GET['infoError'] == 'nodata'){
                    echo '<div class="alert alert-danger">All fields must contain your info. </div>';
                } elseif($_GET['infoError'] == 'success'){
                    echo '<div class="alert alert-success">Your data updated successfully! </div>';
                } elseif($_GET['infoError'] == 'updateError'){
                    echo '<div class="alert alert-danger">Something went wrong. Please try again later. </div>';
                }
            }
        ?>
            <form action="" method="post">
                <div class="form-row">
                    <div class="form-group col-12">
                        <label for="updateEmail">Contact email</label>
                        <input type="email" name="updateEmail" id="updateEmail" class="form-control"
                            value="<?php echo $user->userEmail; ?>">
                    </div>

                    <div class="form-group col-4">
                        <label for="updateGender">Gender</label>
                        <select name="updateGender" id="updateGender" class="custom-select">
                            <option value="0" <?php
                                if($user->userGender == 0){
                                    echo "selected";
                                }
                            ?>>Choose gender</option>
                            <option value="1" <?php
                                if($user->userGender == 1){
                                    echo "selected";
                                }
                            ?>>Female</option>
                            <option value="2" <?php
                                if($user->userGender == 2){
                                    echo "selected";
                                }
                            ?>>Male</option>
                        </select>
                    </div>

                    <div class="form-group col-4">
                        <label for="updateBirth">Birth year</label>
                        <input type="number" name="updateBirth" id="updateBirth" class="form-control"
                            value="<?php echo $user->bornYear; ?>">
                    </div>

                    <div class="form-group col-4">
                        <label for="updateHeight">Height in [cm]</label>
                        <input type="number" name="updateHeight" id="updateHeight" class="form-control"
                            value="<?php echo $user->userHeight; ?>" max="300" step=".01">
                    </div>

                    <button type="submit" class="btn btn-primary btn-block" name="updateUserInfo">Update</button>
                </div><!-- form row -->
            </form>
        </div>

        <div class="col-6 text-left">
            <?php
            if(isset($_GET['weightError'])){
                if($_GET['weightError'] == 'noweight'){
                    echo '<div class="alert alert-danger">Input your current weight. </div>';
                } elseif($_GET['weightError'] == 'success'){
                    echo '<div class="alert alert-success">New weight added. </div>';
                } elseif($_GET['weightError'] == 'updateError'){
                    echo '<div class="alert alert-danger">Something went wrong. Please try again later. </div>';
                } elseif($_GET['weightError'] == 'successDelete'){
                    echo '<div class="alert alert-success">Entry deleted. </div>';
                }
            }
        ?>
            <form action="" method="post">
                <div class="form-row">
                    <div class="form-group col-5">
                        <label for="addWeight">Weight</label>
                        <input type="number" name="addWeight" id="addWeight" class="form-control"
                            placeholder="Weight in kgs" max="300" step=".01">
                    </div>
                    <div class="col-7 d-flex justify-content-center align-items-center">
                        <button type="submit" class="btn btn-primary" name="addWeightBtn">Add weight</button>

                    </div>
                </div><!-- form row -->

            </form>

            <form action="" method="post">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">Date</th>
                            <th scope="col">Weight</th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if($userWeight === NULL){
                            echo '<tr><td class="text-center" colspan="3">No weight</td></tr>';
                        } else{
                            foreach ($userWeight as $data):
                    ?>
                        <tr>
                            <th scope="row"><?php echo $data->weightDate; ?></th>
                            <td><?php echo $data->weight; ?> Kgs</td>
                            <td><a href="?delete=<?php echo $data->weightID; ?>">Delete</a></td>
                        </tr>

                        <?php
                            endforeach;
                        }
                    ?>
                    </tbody>
                </table>
            </form>
        </div>
    </div><!-- row -->


</main>

<?php
    require_once 'includes/footer.php';
?>