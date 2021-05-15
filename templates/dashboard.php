<?php
    require_once 'includes/header.php';
?>
<main class="position-relative overflow-hidden p-3 p-md-5 m-md-3 text-center bg-light">
    <div class="text-left">
        <h2>Hello <?php echo $user->username ?>!</h2>
    </div>

    <div class="mt-5">

        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col" colspan="3">Current data</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Height</td>
                    <td>Weight</td>
                    <td>BMI</td>
                </tr>
                <tr>
                    <td><?php echo $height; ?> cm</td>
                    <td><?php echo $weight; ?> kgs</td>
                    <td><?php echo $bmi.' '.$bmiName; ?></td>
                </tr>
                <tr>
                    <td>BMR</td>
                    <td colspan="2"><?php echo $bmr; ?></td>
                </tr>
            </tbody>
        </table>
    </div>


</main>

<?php
    require_once 'includes/footer.php';
?>