<?php
class Food{
    private $db;

    public function __construct(){
        $this->db = new Database;
    }

    /*public function getMealID($data){
        $this->db->query("SELECT mealID FROM meals WHERE mealName = :mname AND mealDesc = :rec AND userID = :id");

        $this->db->bind(':mname', $data['mealName']);
        $this->db->bind(':rec', $data['mealRecipe']);
        $this->db->bind(':id', $_SESSION['user_id']);

        $result = $this->db->single();
        $mealID = intval($result->mealID);

        return $mealID;
    }

    public function getSumIngr($ingr, $mealID){
        if($ingr = 'kcal'){
            $this->db->query("SELECT SUM(ingrKcal) FROM mealdesc where mealID = :mid");

            $this->db->bind(':mid', $mealID);

            $result = $this->db->singleTab();
            $a = intval($result[0]);

            return a;
        } elseif($ingr = 'prot'){
            $this->db->query("SELECT SUM(ingrProt) FROM mealdesc where mealID = :mid");

            $this->db->bind(':mid', $mealID);

            $result = $this->db->singleTab();
            $a = intval($result[0]);

            return a;
        } elseif($ingr = 'fat'){
            $this->db->query("SELECT SUM(ingrFat) FROM mealdesc where mealID = :mid");

            $this->db->bind(':mid', $mealID);

            $result = $this->db->singleTab();
            $a = intval($result[0]);

            return a;
        } elseif($ingr = 'carb'){
            $this->db->query("SELECT SUM(ingrCarb) FROM mealdesc where mealID = :mid");

            $this->db->bind(':mid', $mealID);

            $result = $this->db->singleTab();
            $a = intval($result[0]);

            return a;
        } elseif($ingr = 'mass'){
            $this->db->query("SELECT SUM(mass) FROM mealdesc where mealID = :mid");

            $this->db->bind(':mid', $mealID);

            $result = $this->db->singleTab();
            $a = intval($result[0]);

            return a;
        } 

    }

    public function addMeal($name){
        $this->db->query("INSERT INTO meals (mealName, mealDesc, userID) VALUES (:mname, :rec, :id)");

        $this->db->bind(':mname', $name['mealName']);
        $this->db->bind(':rec', $name['mealRecipe']);
        $this->db->bind(':id', $_SESSION['user_id']);

        if($this->db->execute()){
            $mealID = $this->getMealID($name);

            $j = count($_SESSION['mealItems']);

            for($k=0; $k<$j; $k++){

                $this->db->query("INSERT INTO mealdesc (mealID, ingrName, ingrKcal, ingrProt, ingrFat, ingrCarb, mass) VALUES (:mid, :iname, :ikcal, :iprot, ifat, icarb, imass)");

                $this->db->bind(':mid', $mealID);
                $this->db->bind(':iname', $_SESSION['mealItems'][$k]['name']);
                $this->db->bind(':ikcal', $_SESSION['mealItems'][$k]['kcal']);
                $this->db->bind(':iprot', $_SESSION['mealItems'][$k]['prot']);
                $this->db->bind('ifat', $_SESSION['mealItems'][$k]['fat']);
                $this->db->bind(':icarb', $_SESSION['mealItems'][$k]['carbs']);
                $this->db->bind('imass', $_SESSION['mealItems'][$k]['mass']);
                
                $this->db->execute();
            }

            $sumKcal = getSumIngr('kcal', $mealID);
            $sumProt = getSumIngr('prot', $mealID);
            $sumFat = getSumIngr('fat', $mealID);
            $sumCarb = getSumIngr('carb', $mealID);
            $sumMass = getSumIngr('mass', $mealID);

            $kcal = (($sumKcal / $sumMass) * 100);
            $prot = (($sumProt / $sumMass) * 100);
            $fat = (($sumFat / $sumMass) * 100);
            $carb = (($sumCarb / $sumMass) * 100);

            $this->db->query("UPDATE meals SET totalEner=:kcal, totalProt=:prot, totalFat=:fat, totalCarbs=:carb WHERE mealID = :mid");

            $this->db->bind(':mid', $mealID);
            $this->db->bind(':kcal', $kcal);
            $this->db->bind(':prot', $prot);
            $this->db->bind(':fat', $fat);
            $this->db->bind('carb', $carb);
            
            if($this->db->execute()){
                unset($_SESSION['mealItems']);
                unset($_SESSION['mealItems100']);

                return True;
            } else{
                return False;
            }

        } else{
            return False;
        }
    }*/

    public function getPlanId($user, $planName){
        $this->db->query("SELECT mealplanID FROM mealplans WHERE planName = :plan AND userID = :id");
        $this->db->bind(':plan', $planName);
        $this->db->bind(':id', $user);

        try{
            $result = $this->db->single();
            $a = $result->mealplanID;
            return $a;
        } catch(PDOException $e){
            return False;
        }
    }

    public function addPlan($id, $planName){
        $this->db->query("INSERT INTO mealplans (planName, userID) VALUES (:plan, :id)");
        $this->db->bind(':plan', $planName);
        $this->db->bind(':id', $id);
        $this->db->execute();

        $mealID = $this->getPlanID($id, $planName);

        if(isset($_SESSION['mealItems'][0])){
            //monday
            $k = count($_SESSION['mealItems'][0]);

            for($i=0; $i<$k; $i++){
                $this->db->query("INSERT INTO meals (mealName, mealMass, kcal, prot, fat, carbs, day, mealplanID) VALUES (:mname, :mmass, :mkcal, :mprot, :mfat, :mcarbs, :mday, :planid)");
                $this->db->bind(':mname', $_SESSION['mealItems'][0][$i]['name']);
                $this->db->bind(':mmass', $_SESSION['mealItems'][0][$i]['mass']);
                $this->db->bind(':mkcal', $_SESSION['mealItems'][0][$i]['kcal']);
                $this->db->bind(':mprot', $_SESSION['mealItems'][0][$i]['prot']);
                $this->db->bind(':mfat', $_SESSION['mealItems'][0][$i]['fat']);
                $this->db->bind(':mcarbs', $_SESSION['mealItems'][0][$i]['carbs']);
                $this->db->bind(':mday', 0);
                $this->db->bind(':planid', $mealID);
                $this->db->execute();
            }
        }

        if(isset($_SESSION['mealItems'][1])){
            //tue
            $k = count($_SESSION['mealItems'][1]);

            for($i=0; $i<$k; $i++){
                $this->db->query("INSERT INTO meals (mealName, mealMass, kcal, prot, fat, carbs, day, mealplanID) VALUES (:mname, :mmass, :mkcal, :mprot, :mfat, :mcarbs, :mday, :planid)");
                $this->db->bind(':mname', $_SESSION['mealItems'][1][$i]['name']);
                $this->db->bind(':mmass', $_SESSION['mealItems'][1][$i]['mass']);
                $this->db->bind(':mkcal', $_SESSION['mealItems'][1][$i]['kcal']);
                $this->db->bind(':mprot', $_SESSION['mealItems'][1][$i]['prot']);
                $this->db->bind(':mfat', $_SESSION['mealItems'][1][$i]['fat']);
                $this->db->bind(':mcarbs', $_SESSION['mealItems'][1][$i]['carbs']);
                $this->db->bind(':mday', 1);
                $this->db->bind(':planid', $mealID);
                $this->db->execute();
            }
        }

        if(isset($_SESSION['mealItems'][2])){
            //wed
            $k = count($_SESSION['mealItems'][2]);

            for($i=0; $i<$k; $i++){
                $this->db->query("INSERT INTO meals (mealName, mealMass, kcal, prot, fat, carbs, day, mealplanID) VALUES (:mname, :mmass, :mkcal, :mprot, :mfat, :mcarbs, :mday, :planid)");
                $this->db->bind(':mname', $_SESSION['mealItems'][2][$i]['name']);
                $this->db->bind(':mmass', $_SESSION['mealItems'][2][$i]['mass']);
                $this->db->bind(':mkcal', $_SESSION['mealItems'][2][$i]['kcal']);
                $this->db->bind(':mprot', $_SESSION['mealItems'][2][$i]['prot']);
                $this->db->bind(':mfat', $_SESSION['mealItems'][2][$i]['fat']);
                $this->db->bind(':mcarbs', $_SESSION['mealItems'][2][$i]['carbs']);
                $this->db->bind(':mday', 2);
                $this->db->bind(':planid', $mealID);
                $this->db->execute();
            }
        }

        if(isset($_SESSION['mealItems'][3])){
            //thu
            $k = count($_SESSION['mealItems'][3]);

            for($i=0; $i<$k; $i++){
                $this->db->query("INSERT INTO meals (mealName, mealMass, kcal, prot, fat, carbs, day, mealplanID) VALUES (:mname, :mmass, :mkcal, :mprot, :mfat, :mcarbs, :mday, :planid)");
                $this->db->bind(':mname', $_SESSION['mealItems'][3][$i]['name']);
                $this->db->bind(':mmass', $_SESSION['mealItems'][3][$i]['mass']);
                $this->db->bind(':mkcal', $_SESSION['mealItems'][3][$i]['kcal']);
                $this->db->bind(':mprot', $_SESSION['mealItems'][3][$i]['prot']);
                $this->db->bind(':mfat', $_SESSION['mealItems'][3][$i]['fat']);
                $this->db->bind(':mcarbs', $_SESSION['mealItems'][3][$i]['carbs']);
                $this->db->bind(':mday', 3);
                $this->db->bind(':planid', $mealID);
                $this->db->execute();
            }
        }

        if(isset($_SESSION['mealItems'][4])){
            //fri
            $k = count($_SESSION['mealItems'][4]);

            for($i=0; $i<$k; $i++){
                $this->db->query("INSERT INTO meals (mealName, mealMass, kcal, prot, fat, carbs, day, mealplanID) VALUES (:mname, :mmass, :mkcal, :mprot, :mfat, :mcarbs, :mday, :planid)");
                $this->db->bind(':mname', $_SESSION['mealItems'][4][$i]['name']);
                $this->db->bind(':mmass', $_SESSION['mealItems'][4][$i]['mass']);
                $this->db->bind(':mkcal', $_SESSION['mealItems'][4][$i]['kcal']);
                $this->db->bind(':mprot', $_SESSION['mealItems'][4][$i]['prot']);
                $this->db->bind(':mfat', $_SESSION['mealItems'][4][$i]['fat']);
                $this->db->bind(':mcarbs', $_SESSION['mealItems'][4][$i]['carbs']);
                $this->db->bind(':mday', 4);
                $this->db->bind(':planid', $mealID);
                $this->db->execute();
            }
        }

        if(isset($_SESSION['mealItems'][5])){
            //sat
            $k = count($_SESSION['mealItems'][5]);

            for($i=0; $i<$k; $i++){
                $this->db->query("INSERT INTO meals (mealName, mealMass, kcal, prot, fat, carbs, day, mealplanID) VALUES (:mname, :mmass, :mkcal, :mprot, :mfat, :mcarbs, :mday, :planid)");
                $this->db->bind(':mname', $_SESSION['mealItems'][5][$i]['name']);
                $this->db->bind(':mmass', $_SESSION['mealItems'][5][$i]['mass']);
                $this->db->bind(':mkcal', $_SESSION['mealItems'][5][$i]['kcal']);
                $this->db->bind(':mprot', $_SESSION['mealItems'][5][$i]['prot']);
                $this->db->bind(':mfat', $_SESSION['mealItems'][5][$i]['fat']);
                $this->db->bind(':mcarbs', $_SESSION['mealItems'][5][$i]['carbs']);
                $this->db->bind(':mday', 5);
                $this->db->bind(':planid', $mealID);
                $this->db->execute();
            }
        }

        if(isset($_SESSION['mealItems'][6])){
            //sun
            $k = count($_SESSION['mealItems'][6]);

            for($i=0; $i<$k; $i++){
                $this->db->query("INSERT INTO meals (mealName, mealMass, kcal, prot, fat, carbs, day, mealplanID) VALUES (:mname, :mmass, :mkcal, :mprot, :mfat, :mcarbs, :mday, :planid)");
                $this->db->bind(':mname', $_SESSION['mealItems'][6][$i]['name']);
                $this->db->bind(':mmass', $_SESSION['mealItems'][6][$i]['mass']);
                $this->db->bind(':mkcal', $_SESSION['mealItems'][6][$i]['kcal']);
                $this->db->bind(':mprot', $_SESSION['mealItems'][6][$i]['prot']);
                $this->db->bind(':mfat', $_SESSION['mealItems'][6][$i]['fat']);
                $this->db->bind(':mcarbs', $_SESSION['mealItems'][6][$i]['carbs']);
                $this->db->bind(':mday', 6);
                $this->db->bind(':planid', $mealID);
                $this->db->execute();
            }
        }

        unset( $_SESSION['mealItems']);
        unset( $_SESSION['mealItems100']);
    }

    public function getUserMealPlans($id){
        $this->db->query("SELECT * FROM mealplans WHERE userID = :id");
        $this->db->bind(':id', $id);

        try{
            $result = $this->db->resultSet();
            return $result;
        } catch(PDOException $e){
            return 0;
        }
    }

    public function getMealPlan($planID){
        $this->db->query("SELECT * FROM meals WHERE mealplanID = :id");
        $this->db->bind(':id', $planID);

        $result = $this->db->resultSet();

        return $result;
    }

    public function changePlan($planID, $userID){
        $this->db->query("UPDATE users SET mealplan = :plan WHERE userID = :id");
        $this->db->bind(':plan', $planID);
        $this->db->bind(':id', $userID);

        $this->db->execute();
    }

}