<?php
    require_once 'includes/header.php';
?>
<main class="position-relative overflow-hidden p-3 p-md-5 m-md-3 text-center bg-light">

    <div class="text-left">
        <div class="row">
            <div class="col-6">
                <h2>Plan this week</h2>
                <h6>Today is <?php echo date('l F j, Y') ?></h6>
                <a href="add-plan.php" class="btn btn-info mt-2">Add meal plan</a>
            </div>

            <div class="col-6">
                <form action="" method="POST">
                    <div class="form-group">
                        <label for="selectMealPlan" class="sr-only">Select meal plan</label>
                        <select class="form-control" id="selectMealPlan" name="selectMealPlan">
                            <?php
                                if($mealplans != 0){
                                    echo '<option value="0">Select meal plan...</option>';
                                    foreach($mealplans as $plan){
                                        echo '<option value="'.$plan->mealplanID.'"';
                                            if($mselected == $plan->mealplanID){
                                                echo 'selected';
                                            }
                                        echo '>'.$plan->planName.'</option>';
                                    }
                                } else{
                                    echo '<option value="0">Select meal plan...</option>';
                                }
                            ?>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-info mt-2" name="mpBtn" value="selectMP">Select meal plan</button>
                    <button type="submit" class="btn btn-info mt-2" name="mpBtn" value="useMP">Use this meal plan</button>
                </form>
            </div>
        </div>
        <!--<a href="#">< previous</a> | <a href="#">next ></a>-->
    </div>

    <div id="weekShow" class="mt-5 row">
        <div id="monday" class="col-6 my-2">
            <h4>Monday</h4>
            <hr>
            <?php
                if(isset($showplan)){
                    foreach($showplan as $a){
                        if($a->day == 0){
                            echo '<p>'.$a->mealName.' '.$a->kcal.' kcal, prot. '.$a->prot.'g fats '.$a->fat.'g carbs. '.$a->carbs.'g</p>';
                        }
                    }
                }
            ?>
        </div>

        <div id="tuesday" class="col-6 my-2">
            <h4>Tuesday</h4>
            <hr>
            <?php
                if(isset($showplan)){
                    foreach($showplan as $a){
                        if($a->day == 1){
                            echo '<p>'.$a->mealName.' '.$a->kcal.' kcal, prot. '.$a->prot.'g fats '.$a->fat.'g carbs. '.$a->carbs.'g</p>';
                        }
                    }
                }
            ?>
        </div>

        <div id="wednesday" class="col-6 my-2">
            <h4>Wednesday</h4>
            <hr>
            <?php
                if(isset($showplan)){
                    foreach($showplan as $a){
                        if($a->day == 2){
                            echo '<p>'.$a->mealName.' '.$a->kcal.' kcal, prot. '.$a->prot.'g fats '.$a->fat.'g carbs. '.$a->carbs.'g</p>';
                        }
                    }
                }
            ?>
        </div>

        <div id="thursday" class="col-6 my-2">
            <h4>Thursday</h4>
            <hr>
            <?php
                if(isset($showplan)){
                    foreach($showplan as $a){
                        if($a->day == 3){
                            echo '<p>'.$a->mealName.' '.$a->kcal.' kcal, prot. '.$a->prot.'g fats '.$a->fat.'g carbs. '.$a->carbs.'g</p>';
                        }
                    }
                }
            ?>
        </div>

        <div id="friday" class="col-6 my-2">
            <h4>Friday</h4>
            <hr>
            <?php
                if(isset($showplan)){
                    foreach($showplan as $a){
                        if($a->day == 4){
                            echo '<p>'.$a->mealName.' '.$a->kcal.' kcal, prot. '.$a->prot.'g fats '.$a->fat.'g carbs. '.$a->carbs.'g</p>';
                        }
                    }}
            ?>
        </div>

        <div id="saturday" class="col-6 my-2">
            <h4>Saturday</h4>
            <hr>
            <?php
                if(isset($showplan)){
                    foreach($showplan as $a){
                        if($a->day == 5){
                            echo '<p>'.$a->mealName.' '.$a->kcal.' kcal, prot. '.$a->prot.'g fats '.$a->fat.'g carbs. '.$a->carbs.'g</p>';
                        }
                    }
                }
            ?>
        </div>

        <div id="sunday" class="col-12 my-2">
            <h4>Sunday</h4>
            <hr>
            <?php
                if(isset($showplan)){
                    foreach($showplan as $a){
                        if($a->day == 6){
                            echo '<p>'.$a->mealName.' '.$a->kcal.' kcal, prot. '.$a->prot.'g fats '.$a->fat.'g carbs. '.$a->carbs.'g</p>';
                        }
                    }
                }
            ?>
        </div>
    </div><!-- weekShow -->




</main>

<?php
    require_once 'includes/footer.php';
?>