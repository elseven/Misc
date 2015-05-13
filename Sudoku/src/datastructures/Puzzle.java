package datastructures;

public class Puzzle {
	public Cell[][] cells = new Cell[9][9];
	
	public Puzzle(String input){
		for(int i=0;i<81;i++){
			cells[i/9][i%9] = new Cell(i,input.charAt(i));
		}
	}
	
	public void solve(){
		
		
		boolean puzzleSolved = false;
		int loops = 0;
		while(!puzzleSolved && loops<30){
			puzzleSolved = true;
			System.out.println("**************************************");
			if(update()){
				break;
			}
			for(int i=0;i<81;i++){
				puzzleSolved = puzzleSolved && cells[i/9][i%9].possibleSolutionsOverlapUpdate(this);
			}
			loops++;
		}
		
		System.err.println("SOLVED? " +puzzleSolved + "(loops:" + loops + ")");
		
	}
	
	private  boolean update(){
		boolean puzzleSolved = true;
		for(int i=0;i<81;i++){
			puzzleSolved = puzzleSolved && this.cells[i/9][i%9].basicUpdate(this);
		}
		return puzzleSolved;
	}
	
	@Override
	public String toString(){
		String s = "";
		for(int i=0;i<9;i++){
			for(int j=0;j<9;j++){
				s+=cells[i][j] + " ";
				if(j%3==2){
					s+=" | ";
				}
			}
			s+="\n";
			if(i%3==2){
				s+="---------------------------\n";
			}
		}
		return s;
	}
	
	

}
