package datastructures;

import java.util.ArrayList;

public class Puzzle {
	public Cell[][] cells = new Cell[9][9];
	public static boolean changed = false;
	public static Puzzle backupPuzzle = null;

	public Puzzle(Puzzle other) {
		this.cells = other.cells.clone();
	}

	public Puzzle(String input) {
		for (int i = 0; i < 81; i++) {
			cells[i / 9][i % 9] = new Cell(i, input.charAt(i));
		}
	}

	public void printPossibleStuff() {
		for (int i = 0; i < 81; i++) {
			Cell temp = cells[i / 9][i % 9];
			if (!temp.getIsSolved()) {
				System.out.println(temp.getPossibleStuff(this));
			}

		}
	}

	public void solve() {

		if (!checkValid()) {
			System.err.println("INVALID!!!!");
		}
		boolean puzzleSolved = false;
		int loops = 0;
		// int solved = getNumberSolved();
		// int prevSolved = 0;
		// while (!puzzleSolved && loops < 100 && (solved != prevSolved)) {
		changed = true;
		while (!puzzleSolved && changed && loops < 10000) {
			changed = false;
			puzzleSolved = true;
			// solved = getNumberSolved();
			// System.out.println("**************************************");
			/*
			 * if (update()) { break; }
			 */
			for (int i = 0; i < 81; i++) {
				boolean temp = cells[i / 9][i % 9].update(this);
				puzzleSolved = puzzleSolved && temp;
			}
			loops++;
			// prevSolved = solved;
			// solved = getNumberSolved();
		}
		System.err.println("SOLVED? " + puzzleSolved + "(loops:" + loops + ")");
		if (!puzzleSolved) {

			guess();

		}

	}

	public void guess() {
		backupPuzzle = new Puzzle(this);

	}

	public boolean checkValid() {
		boolean isValid = true;

		int[][] countsRow = new int[9][9];
		int[][] countsColumn = new int[9][9];
		int[][] countsSquare = new int[9][9];

		for (int i = 0; i < 81; i++) {

			int row = Cell.getRow(i);
			int column = Cell.getColumn(i);
			int square = Cell.getSquare(i);
			Cell tempCell = cells[row][column];
			if (tempCell.getIsSolved()) {
				int answer = tempCell.getAnswer() - 1;
				countsRow[row][answer]++;
				countsColumn[column][answer]++;
				countsSquare[square][answer]++;
				if (countsRow[row][answer] > 1
						|| countsColumn[column][answer] > 1
						|| countsSquare[square][answer] > 1) {
					isValid = false;
					break;
				}
			}
		}
		return isValid;
	}

	private ArrayList<Integer> getAlmostSolvedIndices(int maxSolutions) {
		ArrayList<Integer> almost = new ArrayList<Integer>();

		return almost;
	}

	public int getNumberSolved() {
		int count = 0;
		for (int i = 0; i < 81; i++) {
			int row = i / 9;
			int column = i % 9;
			// System.out.println(row+","+column);
			if (this.cells[row][column].getIsSolved()) {
				count++;
			}
		}
		return count;

	}

	@Override
	public String toString() {
		String s = "";
		for (int i = 0; i < 9; i++) {
			for (int j = 0; j < 9; j++) {
				s += cells[i][j] + " ";
				if (j % 3 == 2) {
					s += " | ";
				}
			}
			s += "\n";
			if (i % 3 == 2) {
				s += "---------------------------\n";
			}
		}
		return s;
	}

}
