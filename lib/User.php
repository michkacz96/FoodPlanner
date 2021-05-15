<?php
class User{
    private $db;

public $p2;

    public function __construct(){
        $this->db = new Database;
    }

    //get all users
    public function getAllUsers(){
        $this->db->query("SELECT * FROM users");

        //assign result set
        $result = $this->db->resultSet();

        return $result;
    }
    //get all users
    public function getSingleUser($id){
        $this->db->query("SELECT * FROM users WHERE userID = :userid");
        $this->db->bind(':userid', $id);

        //assign result set
        $result = $this->db->single();

        return $result;
    }

    public function saltPassword($salt, $pwd){
        $salted = $pwd.$salt.$pwd.$salt.$pwd.$salt.$pwd.$pwd.$salt;

        return $salted;
    }

    //create user
    public function createUser($data){
        /*if(empty($data['username']) || empty($data['email']) || empty($data['pwd1']) || empty($data['pwd2'])){
            //redirect('signup.php', 'Something went wrong!', 'danger')
        }*/
        $userSalt = getRandomString(255);
        $pwdHash = $this->saltPassword($userSalt, $data['pwd1']);
        $pwdHashed = md5($pwdHash);

        $this->db->query("INSERT INTO users (username, userEmail, userPdw, userPwd2) VALUES (:username, :email, :pwdHash, :userSalt)");

        $this->db->bind(':username', $data['username']);
        $this->db->bind(':email', $data['email']);
        $this->db->bind(':pwdHash', $pwdHashed);
        $this->db->bind(':userSalt', $userSalt);
        

        if($this->db->execute()){
            return true;
        } else{
            return false;
        }
    }

    public function checkUser($data){
        $this->db->query("SELECT * FROM users WHERE username = :uid OR userEmail = :uid");
        $this->db->bind(':uid', $data['username']);
        
 
        if($this->db->single()){
            $instance = $this->db->single();       
            $hash = $this->saltPassword($instance->userPwd2, $data['pwd']);
            $hashed = md5($hash);
             
            if($hashed == $instance->userPdw){
                       
                $_SESSION['loggedin'] = true;
                $_SESSION['user_id'] = $instance->userID;
                $_SESSION['user_email'] = $instance->userEmail;
                $_SESSION['username'] = $instance->username;

                return 1;
            
            } else{
                $_SESSION['loggedin'] = False;
                return $hashed;
              
            }
        } else{
            //no user in database
            header('Location: signin.php?error=nouser');
        }    
    }

    public function getWeight($id, $limit = NULL){
        if(is_null($limit)){
            $this->db->query("SELECT * FROM `user-weight` WHERE userID = :userid");
            $this->db->bind(':userid', $id);

            //assign result set
            try{
                $result = $this->db->resultSet();
                return $result;
            } catch (PDOException $e){
                return NULL;
            }

        } else{
            $this->db->query("SELECT * FROM `user-weight` WHERE userID = :userid LIMIT :limit");
            $this->db->bind(':userid', $id);
            $this->db->bind(':limit', $limit);

            //assign result set
            try{
                $result = $this->db->resultSet();
                return $result;
            } catch (PDOException $e){
                return False;
            }
        }
    }

    public function addWeight($weight, $id){
        $this->db->query("INSERT INTO `user-weight` (weightDate, weight, userID) VALUES (:currentDate, :userweight, :id)");
        $this->db->bind(':currentDate', strval(date('Y-m-d H:i:s')));
        $this->db->bind(':userweight', $weight);
        $this->db->bind(':id', $id);

        if($this->db->execute()){
            return True;
        } else{
            return False;
        }
    }

    public function updateInfo($data, $id){
        $this->db->query("UPDATE `users` SET userEmail = :email, userGender = :gender, bornYear = :yearBorn, userHeight = :height WHERE userID = :id");
        $this->db->bind(':email', $data['updateEmail']);
        $this->db->bind(':gender', $data['updateGender']);
        $this->db->bind(':yearBorn', $data['updateBirth']);
        $this->db->bind(':height', $data['updateHeight']);
        $this->db->bind(':id', $id);

        if($this->db->execute()){
            return True;
        } else{
            return False;
        }
    }

    public function getLastWeight($id){
        $this->db->query("SELECT weight FROM `user-weight` WHERE userID=:id ORDER BY weightID DESC LIMIT 1");
        $this->db->bind(':id', $id);

        try{
            $result = $this->db->single();
            return $result;
        } catch(PDOException $e){
            return False;
        }

        
    }

    public function getHeight($id){
        $this->db->query("SELECT userHeight FROM users WHERE userID = :id");
        $this->db->bind(':id', $id);

        try{
            $result = $this->db->single();
            return $result;
        } catch(PDOException $e){
            return 1;
        }
        
    }

    public function getBMI($id){
        if($this->getLastWeight($id)){
            $weight = $this->getLastWeight($id)->weight;
        } else{
            $weight = 0;
        }
        $height = $this->getHeight($id)->userHeight;

        if($height == 0){
            $height = 1;
        } else{
            $height = $height/100;
        }

        $bmi = $weight/($height * $height);
        $bmi = round($bmi, 1);

        return $bmi;
    }

    public function getAge($id){
        $today = intval(date('Y'));
        
        $this->db->query("SELECT bornYear FROM users WHERE userID = :id");
        $this->db->bind(':id', $id);

        try{
            $result = $this->db->single();
            $age = $today - $result->bornYear;
            return $age;
        } catch(PDOException $e){
            return False;
        }
    }

    public function getBmiName($bmi){
        if($bmi < 18.5){
            return 'Underweight';
        } elseif($bmi >= 18.5 && $bmi < 25){
            return 'Normal weight';
        } elseif($bmi >= 25 && $bmi < 30){
            return 'Overweight';
        }elseif($bmi > 30){
            return 'Obese';
        }
    }

    public function deleteWeight($id){
        $this->db->query("DELETE FROM `user-weight` WHERE weightID = :id");
        $this->db->bind(':id', $id);

        if($this->db->execute()){
            return True;
        } else{
            return False;
        }
    }

    public function getBMR($id){
        $user = $this->getSingleUser($id);
        if($this->getLastWeight($id) != False){
            $weight = $this->getLastWeight($id)->weight;
        } else{
            $weight = 0;
        }
        $height = $this->getHeight($id)->userHeight;
        $age = $this->getAge($id);

        if($user->userGender == 1){
            //female
            $bmr = ((9.247 * $weight) + (3.098 * $height) - (4.33 * $age) + 447.593);
            $bmr = round($bmr).' kcal per day';
        } elseif($user->userGender == 2){
            //male
            $bmr = ((13.397 * $weight) + (4.799 * $height) - (5.667 * $age) + 88.362);
            $bmr = round($bmr).' kcal per day';
        } else{
            $bmr = 'Select your gender <a href="user-info.php">here</a>';
        }

        return $bmr;
    }

    public function getPlan($id){
        $this->db->query("SELECT mealplan FROM users WHERE userID = :id");
        $this->db->bind(':id', $id);

        $result = $this->db->single();
        $a = $result->mealplan;

        return $a;
    }
}