<?php
    require_once 'includes/header.php';
?>
<main class="position-relative overflow-hidden p-3 p-md-5 m-md-3 bg-light text-left">

    <form action="" method="post">
        <!-- search -->
        <div class="row">
            <div class="form-group col-6">
                <label for="searchQuery" class="sr-only">Search</label>
                <input type="text" class="form-control" name="searchQuery" id="searchQuery" placeholder="Search ...">
            </div>
            <div class="form-group col-6">
                <button type="submit" class="btn btn-primary" name="searchBtn">Search</button>
            </div>
        </div>

        <div id="temp" class="mt-2 text-left">
                <?php 
            if(isset($foodItem)){
                echo '<form action="" method="get">
                <table class="table table-striped">';
                echo '<tr><th>Name</th><th>Ener</th><th>Prot</th><th>Fat</th><th>Carbs</th><th></th></tr>';
                $j = count($foodItem['hints']);
                for($i=0; $i<$j; $i++){
                    if($i > 8){
                        break;
                    }
                    if(is_array($foodItem['hints'][$i])){
                        echo '<tr>
                        <td>'.$foodItem['hints'][$i]['food']['label'].'</td>
                        <td>'.round($foodItem['hints'][$i]['food']['nutrients']['ENERC_KCAL'],2).' kcal</td>
                        <td>'.round($foodItem['hints'][$i]['food']['nutrients']['PROCNT'],2).' g</td>
                        <td>'.round($foodItem['hints'][$i]['food']['nutrients']['FAT'],2).' g</td>
                        <td>'.round($foodItem['hints'][$i]['food']['nutrients']['CHOCDF'],2).' g</td>
                        <td><input type="radio" class="form-check-input" name="item" value="item_'.$i.'">
                        <input type="hidden" name="item_'.$i.'[name]" value="'.$foodItem['hints'][$i]['food']['label'].'">
                        <input type="hidden" name="item_'.$i.'[kcal]" value="'.round($foodItem['hints'][$i]['food']['nutrients']['ENERC_KCAL'],2).'">
                        <input type="hidden" name="item_'.$i.'[protein]" value="'.round($foodItem['hints'][$i]['food']['nutrients']['PROCNT'],2).'">
                        <input type="hidden" name="item_'.$i.'[fat]" value="'.round($foodItem['hints'][$i]['food']['nutrients']['FAT'],2).'">
                        <input type="hidden" name="item_'.$i.'[carbs]" value="'.round($foodItem['hints'][$i]['food']['nutrients']['CHOCDF'],2).'">
                        </tr>';
                        ++$i;
                    } else{
                        break;
                    }                    
                }
                echo '</table>
                        <div class="row">
                            <select class="form-control col-8" name="weekDay">
                                <option value="0">Monday</option>
                                <option value="1">Tuesday</option>
                                <option value="2">Wednesday</option>
                                <option value="3">Thursday</option>
                                <option value="4">Friday</option>
                                <option value="5">Saturday</option>
                                <option value="6">Sunday</option>
                            </select>
                            <button type="submit" class="btn btn-primary col-4" name="add">Add</button>
                            </div>
                    </form>';
            }
                ?>
            </div>
    </form>
        <hr>
        <!-- Meal details -->
    <form action="" method="post">
        <div id="monday" class="text-center">
            <h4>Monday</h4>

            <div class="jumbotron bg-secondary">
                <?php
                    if(isset($_SESSION['mealItems'][0])){
                        echo '<table class="table table-striped table-sm">
                        <tr>
                            <th>Name</th>
                            <th>Mass</th>
                            <th>Prot</th>
                            <th>Fat</th>
                            <th>Carbs</th>
                            <th>kcal</th>
                            <th></th>
                        </tr>';
                        
                        $j = count($_SESSION['mealItems'][0]);

                        for($k=0; $k<$j; $k++){
                            echo '<tr>';
                                echo '<th>'.$_SESSION['mealItems'][0][$k]['name'].'</th>';
                                echo '<th><input type="number" class="form-control" value="'.$_SESSION['mealItems'][0][$k]['mass'].'" name="updateMass[0]['.$k.']"></th>';
                                echo '<th>'.$_SESSION['mealItems'][0][$k]['prot'].'</th>';
                                echo '<th>'.$_SESSION['mealItems'][0][$k]['fat'].'</th>';
                                echo '<th>'.$_SESSION['mealItems'][0][$k]['carbs'].'</th>';
                                echo '<th>'.$_SESSION['mealItems'][0][$k]['kcal'].'</th>';
                                echo '<input type="hidden" name="updateValue[0]" value="'.$k.'">';
                                echo '<th><button type="submit" class="btn btn-info" name="dayName" value="0">Update</button></th>';
                                //echo '<th><input type="hidden" name="updateValue" value="'.$k.'"</th>'
                            echo '</tr>';
                        }
                        echo '</table>';
                    }
                ?>
            </div>
        </div>

        <div id="tuesday" class="text-center">
            <h4>Tuesday</h4>

            <div class="jumbotron bg-secondary">
            <?php
                    if(isset($_SESSION['mealItems'][1])){
                        echo '<table class="table table-striped table-sm">
                        <tr>
                            <th>Name</th>
                            <th>Mass</th>
                            <th>Prot</th>
                            <th>Fat</th>
                            <th>Carbs</th>
                            <th>kcal</th>
                            <th></th>
                        </tr>';
                        
                        $j = count($_SESSION['mealItems'][1]);

                        for($k=0; $k<$j; $k++){
                            echo '<tr>';
                                echo '<th>'.$_SESSION['mealItems'][1][$k]['name'].'</th>';
                                echo '<th><input type="number" class="form-control" value="'.$_SESSION['mealItems'][1][$k]['mass'].'" name="updateMass[1]['.$k.']"></th>';
                                echo '<th>'.$_SESSION['mealItems'][1][$k]['prot'].'</th>';
                                echo '<th>'.$_SESSION['mealItems'][1][$k]['fat'].'</th>';
                                echo '<th>'.$_SESSION['mealItems'][1][$k]['carbs'].'</th>';
                                echo '<th>'.$_SESSION['mealItems'][1][$k]['kcal'].'</th>';
                                echo '<input type="hidden" name="updateValue[1]" value="'.$k.'">';
                                echo '<th><button type="submit" class="btn btn-info" name="dayName" value="1">Update</button></th>';
                                //echo '<th><input type="hidden" name="updateValue" value="'.$k.'"</th>'
                            echo '</tr>';
                        }
                        echo '</table>';
                    }
                ?>
            </div>
        </div>

        <div id="wednesday" class="text-center">
            <h4>Wednesday</h4>

            <div class="jumbotron bg-secondary">
            <?php
                    if(isset($_SESSION['mealItems'][2])){
                        echo '<table class="table table-striped table-sm">
                        <tr>
                            <th>Name</th>
                            <th>Mass</th>
                            <th>Prot</th>
                            <th>Fat</th>
                            <th>Carbs</th>
                            <th>kcal</th>
                            <th></th>
                        </tr>';
                        
                        $j = count($_SESSION['mealItems'][2]);

                        for($k=0; $k<$j; $k++){
                            echo '<tr>';
                                echo '<th>'.$_SESSION['mealItems'][2][$k]['name'].'</th>';
                                echo '<th><input type="number" class="form-control" value="'.$_SESSION['mealItems'][2][$k]['mass'].'" name="updateMass[2]['.$k.']"></th>';
                                echo '<th>'.$_SESSION['mealItems'][2][$k]['prot'].'</th>';
                                echo '<th>'.$_SESSION['mealItems'][2][$k]['fat'].'</th>';
                                echo '<th>'.$_SESSION['mealItems'][2][$k]['carbs'].'</th>';
                                echo '<th>'.$_SESSION['mealItems'][2][$k]['kcal'].'</th>';
                                echo '<input type="hidden" name="updateValue[2]" value="'.$k.'">';
                                echo '<th><button type="submit" class="btn btn-info" name="dayName" value="2">Update</button></th>';
                                //echo '<th><input type="hidden" name="updateValue" value="'.$k.'"</th>'
                            echo '</tr>';
                        }
                        echo '</table>';
                    }
                ?>
            </div>
        </div>

        <div id="thursday" class="text-center">
            <h4>Thursday</h4>

            <div class="jumbotron bg-secondary">
            <?php
                    if(isset($_SESSION['mealItems'][3]) && $_SESSION['mealItems'][3] != NULL){
                        echo '<table class="table table-striped table-sm">
                        <tr>
                            <th>Name</th>
                            <th>Mass</th>
                            <th>Prot</th>
                            <th>Fat</th>
                            <th>Carbs</th>
                            <th>kcal</th>
                            <th></th>
                        </tr>';
                        
                        $j = count($_SESSION['mealItems'][3]);

                        for($k=0; $k<$j; $k++){
                            echo '<tr>';
                                echo '<th>'.$_SESSION['mealItems'][3][$k]['name'].'</th>';
                                echo '<th><input type="number" class="form-control" value="'.$_SESSION['mealItems'][3][$k]['mass'].'" name="updateMass[3]['.$k.']"></th>';
                                echo '<th>'.$_SESSION['mealItems'][3][$k]['prot'].'</th>';
                                echo '<th>'.$_SESSION['mealItems'][3][$k]['fat'].'</th>';
                                echo '<th>'.$_SESSION['mealItems'][3][$k]['carbs'].'</th>';
                                echo '<th>'.$_SESSION['mealItems'][3][$k]['kcal'].'</th>';
                                echo '<input type="hidden" name="updateValue[3]" value="'.$k.'">';
                                echo '<th><button type="submit" class="btn btn-info" name="dayName" value="3">Update</button></th>';
                                //echo '<th><input type="hidden" name="updateValue" value="'.$k.'"</th>'
                            echo '</tr>';
                        }
                        echo '</table>';
                    }
                ?>
            </div>
        </div>

        <div id="friday" class="text-center">
            <h4>Friday</h4>

            <div class="jumbotron bg-secondary">
            <?php
                    if(isset($_SESSION['mealItems'][4])){
                        echo '<table class="table table-striped table-sm">
                        <tr>
                            <th>Name</th>
                            <th>Mass</th>
                            <th>Prot</th>
                            <th>Fat</th>
                            <th>Carbs</th>
                            <th>kcal</th>
                            <th></th>
                        </tr>';
                        
                        $j = count($_SESSION['mealItems'][4]);

                        for($k=0; $k<$j; $k++){
                            echo '<tr>';
                                echo '<th>'.$_SESSION['mealItems'][4][$k]['name'].'</th>';
                                echo '<th><input type="number" class="form-control" value="'.$_SESSION['mealItems'][4][$k]['mass'].'" name="updateMass[4]['.$k.']"></th>';
                                echo '<th>'.$_SESSION['mealItems'][4][$k]['prot'].'</th>';
                                echo '<th>'.$_SESSION['mealItems'][4][$k]['fat'].'</th>';
                                echo '<th>'.$_SESSION['mealItems'][4][$k]['carbs'].'</th>';
                                echo '<th>'.$_SESSION['mealItems'][4][$k]['kcal'].'</th>';
                                echo '<input type="hidden" name="updateValue[4]" value="'.$k.'">';
                                echo '<th><button type="submit" class="btn btn-info" name="dayName" value="4">Update</button></th>';
                                //echo '<th><input type="hidden" name="updateValue" value="'.$k.'"</th>'
                            echo '</tr>';
                        }
                        echo '</table>';
                    }
                ?>
            </div>
        </div>

        <div id="saturday" class="text-center">
            <h4>Saturday</h4>

            <div class="jumbotron bg-secondary">
            <?php
                    if(isset($_SESSION['mealItems'][5])){
                        echo '<table class="table table-striped table-sm">
                        <tr>
                            <th>Name</th>
                            <th>Mass</th>
                            <th>Prot</th>
                            <th>Fat</th>
                            <th>Carbs</th>
                            <th>kcal</th>
                            <th></th>
                        </tr>';
                        
                        $j = count($_SESSION['mealItems'][5]);

                        for($k=0; $k<$j; $k++){
                            echo '<tr>';
                                echo '<th>'.$_SESSION['mealItems'][5][$k]['name'].'</th>';
                                echo '<th><input type="number" class="form-control" value="'.$_SESSION['mealItems'][5][$k]['mass'].'" name="updateMass[5]['.$k.']"></th>';
                                echo '<th>'.$_SESSION['mealItems'][5][$k]['prot'].'</th>';
                                echo '<th>'.$_SESSION['mealItems'][5][$k]['fat'].'</th>';
                                echo '<th>'.$_SESSION['mealItems'][5][$k]['carbs'].'</th>';
                                echo '<th>'.$_SESSION['mealItems'][5][$k]['kcal'].'</th>';
                                echo '<input type="hidden" name="updateValue[5]" value="'.$k.'">';
                                echo '<th><button type="submit" class="btn btn-info" name="dayName" value="5">Update</button></th>';
                                //echo '<th><input type="hidden" name="updateValue" value="'.$k.'"</th>'
                            echo '</tr>';
                        }
                        echo '</table>';
                    }
                ?>
            </div>
        </div>

        <div id="sunday" class="text-center">
            <h4>Sunday</h4>

            <div class="jumbotron bg-secondary">
            <?php
                    if(isset($_SESSION['mealItems'][6])){
                        echo '<table class="table table-striped table-sm">
                        <tr>
                            <th>Name</th>
                            <th>Mass</th>
                            <th>Prot</th>
                            <th>Fat</th>
                            <th>Carbs</th>
                            <th>kcal</th>
                            <th></th>
                        </tr>';
                        
                        $j = count($_SESSION['mealItems'][6]);

                        for($k=0; $k<$j; $k++){
                            echo '<tr>';
                                echo '<th>'.$_SESSION['mealItems'][6][$k]['name'].'</th>';
                                echo '<th><input type="number" class="form-control" value="'.$_SESSION['mealItems'][6][$k]['mass'].'" name="updateMass[6]['.$k.']"></th>';
                                echo '<th>'.$_SESSION['mealItems'][6][$k]['prot'].'</th>';
                                echo '<th>'.$_SESSION['mealItems'][6][$k]['fat'].'</th>';
                                echo '<th>'.$_SESSION['mealItems'][6][$k]['carbs'].'</th>';
                                echo '<th>'.$_SESSION['mealItems'][6][$k]['kcal'].'</th>';
                                echo '<input type="hidden" name="updateValue[6]" value="'.$k.'">';
                                echo '<th><button type="submit" class="btn btn-info" name="dayName" value="6">Update</button></th>';
                                //echo '<th><input type="hidden" name="updateValue" value="'.$k.'"</th>'
                            echo '</tr>';
                        }
                        echo '</table>';
                    }
                ?>
            </div>
        </div>
        </div>

        <hr>
        <div class="row">
            <div class="form-group col-6">
                <label for="planName" class="sr-only">Plan name</label>
                <input type="text" class="form-control" name="planName" id="planName" placeholder="Meal plan name">
            </div>
            <div class="form-group col-6">
                <button type="submit" class="btn btn-primary" name="addPlan">Add plan</button>
            </div>
        </div>
        
    </form>
</main>

<?php
    require_once 'includes/footer.php';
?>