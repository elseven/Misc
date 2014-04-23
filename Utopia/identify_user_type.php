<?php

require_once 'constants.php';


class User {

	public $movie_count;
	public $game_count;
	public $lang_count;
	public $politics_count;
	public $team_count;
	public $religion_count;
	public $education;
	public $book_count;
	public $tv_count;
	public $athlete_count;
	public $music_count;

	public $travel_type_graph;

	public $adventure_score = 0;
	public $leisure_score = 0;
	public $culture_score = 0;
	public $entertainment_score = 0;

	public $user_type;
	
	public function __construct($travel_type_graph, $user_type) {
	
	$this->travel_type_graph = $travel_type_graph;

	$this->count_movies();
	$this->count_games();
	$this->count_languages();
	$this->count_politics();
	$this->count_teams();
	$this->count_religions();
	$this->schools_attended();
	$this->count_books();
	$this->count_tv_shows();
	$this->count_athletes();
	$this->count_music();

	$this->calculate_adventure_score();
	$this->calculate_leisure_score();
	$this->calculate_culture_score();
	$this->calculate_entertainment_score();

	$this->user_type = $this->find_max_type();
	}

/*==============================================================================================
======================================TRAVEL TYPE SCORE CALCULATIONS============================
================================================================================================*/

	public function calculate_adventure_score () {

		$this->adventure_score = $this->adventure_score += ($this->team_count * 2);
		$this->adventure_score = $this->adventure_score += ($this->athlete_count * .5);

		// echo "Adventure score: ".$this->adventure_score."<br>";
	}

	public function calculate_leisure_score () {
/*		if ($this->game_count > 1){
			$this->leisure_score += 3;
		}*/

		$this->leisure_score = $this->leisure_score += $this->game_count;
		$this->leisure_score = $this->leisure_score += ($this->movie_count / 5);
		$this->leisure_score = $this->leisure_score += ($this->book_count * 2);
		$this->leisure_score = $this->leisure_score += ($this->tv_count / 5);

		// echo "Leisure score: ".$this->leisure_score."<br>";
	}

	public function calculate_culture_score () {
/*		if ($this->movie_count > 5){
			$this->culture_score += 1;
		}
		if ($this->lang_count > 1){
			$this->culture_score += 5;
		}
		if ($this->lang_count > 2){
			$this->culture_score += 7;
		}
		if ($this->politics > 0){
			$this->culture_score += 5;
		}*/

		$this->culture_score = $this->culture_score += ($this->lang_count * 5);
		$this->culture_score = $this->culture_score += ($this->movie_count / 5);
		$this->culture_score = $this->culture_score += $this->book_count;
		$this->culture_score = $this->culture_score += ($this->music_count / 2);


		if ($this->politics_count > 0){
			$this->culture_score += 3;
		}
		if ($this->religion_count > 0){
			$this->culture_score += 3;
		}
		if ($this->education = "College"){
			$this->culture_score += 3;
		}

		// echo "Culture score: ".$this->culture_score."<br>";
	}

	public function calculate_entertainment_score () {
/*		if ($this->movie_count > 5){
			$this->entertainment_score += 5;
		}
		if ($this->movie_count > 10){
			$this->entertainment_score += 5;
		}

		if ($this->game_count > 0){
			$this->entertainment_score += 3;
		}*/

		$this->entertainment_score = $this->entertainment_score += ($this->movie_count / 2);
		$this->entertainment_score = $this->entertainment_score += ($this->game_count / 2);
		$this->entertainment_score = $this->entertainment_score += $this->team_count/2;
		$this->entertainment_score = $this->entertainment_score += ($this->tv_count / 2);
		$this->entertainment_score = $this->entertainment_score += ($this->music_count / 2);

		// echo "Entertainment score: ".$this->entertainment_score;
	}

/*==============================================================================================
======================================USER'S DATA TO VARIABLE CALCULATIONS======================
================================================================================================*/


	private function count_languages(){
		 $this->lang_count = count($this->travel_type_graph['languages']);
	}

	private function count_games(){
		 $this->game_count = count($this->travel_type_graph['games']['data']);
	}

	private function count_movies(){
		 $this->movie_count = count($this->travel_type_graph['movies']['data']);
	}

	private function count_politics(){
		 $this->politics_count = count($this->travel_type_graph['political']);
	}
	private function count_teams(){
		 $this->team_count = count($this->travel_type_graph['favorite_teams']);
	}
	private function count_religions(){
		 $this->religion_count = count($this->travel_type_graph['religion']);
	}
	private function schools_attended(){
		 $this->education = $this->travel_type_graph['education'];
	}
	private function count_books(){
		 $this->book_count = count($this->travel_type_graph['books']['data']);
	}
	private function count_tv_shows(){
		 $this->tv_count = count($this->travel_type_graph['television']['data']);
	}
	private function count_athletes(){
		 $this->athlete_count = count($this->travel_type_graph['favorite_athletes']);
	}
	private function count_music(){
		 $this->music_count = count($this->travel_type_graph['music']['data']);
	}

	
/*==============================================================================================
======================================DETERMINE USER'S TYPE=====================================
================================================================================================*/

	public function find_max_type () {
		$score_array = array(
			ADVENTURE => $this->adventure_score, 
			LEISURE => $this->leisure_score, 
			CULTURE => $this->culture_score, 
			ENTERTAINMENT => $this->entertainment_score);
		$max_score = 0;
		$max_type = ADVENTURE;
		foreach ($score_array as $key => $value) {
			if ($value > $max_score) {
				$max_type = $key;
				$max_score = $value;
			}
		}
		return $max_type;
	}
	public function get_type_as_string () {
		$type_string;
		switch ($this->user_type) {
			case ADVENTURE: $type_string = "Adventure";
			break;
			case LEISURE: $type_string = "Leisure";
			break;
			case CULTURE: $type_string = "Culture";
			break;
			case ENTERTAINMENT: $type_string = "Entertainment";
			break;
		}
		return $type_string;
	}	
}





	




?>