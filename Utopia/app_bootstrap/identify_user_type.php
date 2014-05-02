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
	public $likes;
	public $movie_data;
	public $tv_data;
	public $places_count;

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
	$this->likes_categories();
	$this->movie_data_filter();
	$this->tv_data_filter();
	$this->count_places();

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

		foreach ($this->likes as $l) {
		 	if (($l['category'] == "Sports/recreation/activities") || 
		 		($l['category'] == "Attractions/things to do") ||
		 		($l['category'] == "Travel/leisure") ||
		 		($l['category'] == "Professional sports team") ||
		 		($l['category'] == "Sports league") ||
		 		($l['category'] == "Outdoor gear/sporting goods")) {
		 		$this->adventure_score += 1;
		 	}
		}

		foreach ($this->likes as $ll) {
			
			$cat_list=$ll['category_list'];
			if($cat_list!=null){
				foreach($cat_list as $cat_element) {
				 	if (($cat_element['name'] == "Theme Park") ||
					 	($cat_element['name'] == "Amusement Park Ride") ||
					 	($cat_element['name'] == "Sports & Recreation") ||
					 	($cat_element['name'] == "Campground") ||
					 	($cat_element['name'] == "Outdoor Recreation") ||
					 	($cat_element['name'] == "Ski Resort") ||
					 	($cat_element['name'] == "Sporting Goods Store") ||
					 	($cat_element['name'] == "Outdoor Equipment Store") ||
					 	($cat_element['name'] == "Park")) {
				 		$this->adventure_score += 1;
				 	}
				}
			}
		}

		foreach ($this->movie_data as $movie) {
			
			$genre_string = $movie['genre'];

		
			if($genre_string!=null) {
				//echo ($genre_string);
			//$genre_arr = explode(",",$genre_string);

		 		//$genre_string = strtolower($genre_string);
		 		
		 		
		 		if((stripos($genre_string,"action") !== FALSE) || 
		 			(stripos($genre_string,"adventure") !== FALSE) || 
		 			(stripos($genre_string,"thriller") !== FALSE) || 
		 			(stripos($genre_string,"sci-fi") !== FALSE)) {
		 			$this->adventure_score += 1;
		 		}
			 	
			}
		}
		echo "Adventure score: ".$this->adventure_score."<br>";
	}

	public function calculate_leisure_score () {
/*		if ($this->game_count > 1){
			$this->leisure_score += 3;
		}*/

		$this->leisure_score = $this->leisure_score += $this->game_count;
		$this->leisure_score = $this->leisure_score += ($this->movie_count / 5);
		$this->leisure_score = $this->leisure_score += ($this->book_count * 2);
		$this->leisure_score = $this->leisure_score += ($this->tv_count / 5);

		foreach ($this->likes as $ll) {
			
			$cat_list=$ll['category_list'];
			if($cat_list!=null){
				foreach($cat_list as $cat_element) {
				 	if (($cat_element['name'] == "Spa") ||
					 	($cat_element['name'] == "Amusement Park Ride") ||
					 	($cat_element['name'] == "Sports & Recreation") ||
					 	($cat_element['name'] == "Campground") ||
					 	($cat_element['name'] == "Outdoor Recreation") ||
					 	($cat_element['name'] == "Ski Resort")) {
				 		$this->leisure_score += 1;
				 	}
				}
			}
		}

		echo "Leisure score: ".$this->leisure_score."<br>";
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
		$this->culture_score = $this->culture_score += $this->places_count;


		if ($this->politics_count > 0){
			$this->culture_score += 3;
		}
		if ($this->religion_count > 0){
			$this->culture_score += 3;
		}
		if ($this->education = "College"){
			$this->culture_score += 3;
		}

		foreach ($this->likes as $l) {
		 	if (($l['category'] == "Shopping/retail")) {
		 		$this->culture_score += 1;
		 	}
		}

		echo "Culture score: ".$this->culture_score."<br>";
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
		$this->entertainment_score = $this->entertainment_score += $this->team_count / 2;
		$this->entertainment_score = $this->entertainment_score += ($this->tv_count / 2);
		$this->entertainment_score = $this->entertainment_score += ($this->music_count / 2);

		/*foreach ($this->likes as $l) {
		 	if ($l['category'] == "Movie") {
		 		$this->entertainment_score += 1;
		 	}
		}

		foreach ($this->tv_data as $show) {

			$tv_genre_string = $show['genre'];
			if($tv_genre_string!=null) {
			$tv_genre_arr = explode(",",$tv_genre_string);

			 	foreach ($tv_genre_arr as $tv_element) {
			 		$tv_element = trim($tv_element);
			 		if(($tv_element == "Comedy") || 
			 		($tv_element == "Adventure") ||
			 		($tv_element == "Thriller") ||
			 		($tv_element == "Sci-Fi")) {
			 			$this->entertainment_score += 1;
			 		}
			 	}
			}
		}

		foreach ($this->likes as $ll) {
			
			$cat_list=$ll['category_list'];
			if($cat_list!=null){
				foreach($cat_list as $cat_element) {
				 	if (($cat_element['name'] == "Concert Venue") ||
				 		($cat_element['name'] == "Event Venue")) {
				 		$this->entertainment_score += 1;
				 	}
				}
			}
		}*/

		echo "Entertainment score: ".$this->entertainment_score;
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
		 /*echo "<pre>";
		 print_r($this->travel_type_graph['movies']['data']);
		 echo "</pre>";*/
		 //var_dump($this->travel_type_graph);
		 //echo $this->movie_count;
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
	private function likes_categories(){
		$this->likes = $this->travel_type_graph['likes']['data'];
	}
	private function movie_data_filter(){
		$this->movie_data = $this->travel_type_graph['movies']['data'];
		 /*echo "<pre>";
		 print_r($this->travel_type_graph['movies']['data']);
		 echo "</pre>";
*/
	}
	private function tv_data_filter(){
		$this->tv_data = $this->travel_type_graph['television']['data'];
	}
	private function count_places(){
		 $this->places_count = count($this->travel_type_graph['tagged_places']['data']);
		 echo "<pre>";
		 print_r($this->travel_type_graph);
		 echo "</pre>";

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