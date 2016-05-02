<?php


class Exercise extends BaseModel{
	public $id, $workout_id, $name, $weight;

	public function __construct($attributes){
		parent::__construct($attributes);
	}

	public static function findByWorkout($id){
		$query = DB::connection()->prepare('SELECT * FROM WeightExercise WHERE workoutid = :id');
		$query->execute(array('id' => $id));
		$rows = $query->fetchAll();

		$exercises = array();

		foreach($rows as $row){
			$exercises[] = new Exercise(array(
				'id' => $row['id'],
				'workout_id' => $row['workoutid'],
				'name' => $row['name'],
				'weight' => $row['weight']
				));
		}
		return $exercises;
	}

	public function save(){
		if(!strcmp($this->name, ""))return;
		$query = DB::connection()->prepare('INSERT INTO weightExercise (WorkoutId, Name, Weight) VALUES (:workoutid, :name, :weight) RETURNING id');
		$query->execute(array('name' => $this->name, 'workoutid' => $this->workout_id, 'weight' => $this->weight));
		// $row = $query->fetch();
		// $this->id = $row['id'];
		//NÄITÄ EI KAIT TARTTE
	}
}

class Cardio extends BaseModel{
	 public $id, $workout_id, $name, $duration, $distance;

	 public function __construct($attributes){
	 	parent::__construct($attributes);
	 }

	 public static function findByWorkout($id){
	 	$query = DB::connection()->prepare('SELECT * FROM CardioExercise WHERE workoutid = :id');
	 	$query->execute(array('id' => $id));
	 	$rows = $query->fetchAll();

	 	$cardios = array();

	 	foreach($rows as $row){
	 		$cardios[] = new Cardio(array(
	 			'id' => $row['id'],
				'workout_id' => $row['workoutid'],
				'name' => $row['name'],
				'duration' => $row['duration'],
				'distance' => $row['distance']
	 			));
	 	}

	 	return $cardios;

	 }
}