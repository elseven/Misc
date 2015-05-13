package datastructures;

import java.util.ArrayList;
import java.util.HashMap;

public class Puzzle {
	public Cell[][] cells = new Cell[9][9];

	public static boolean changed = false;
	public static Puzzle backupPuzzle = null;
	public static int guessCellIndex = -1;
	public static int guessAnswer = -1;
	public static HashMap<Integer, ArrayList<Integer>> failedGuesses = new HashMap<Integer, ArrayList<Integer>>();

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
			return;
		}
		boolean puzzleSolved = false;
		int loops = 0;

		changed = true;
		while (!puzzleSolved && changed && loops < 10000) {
			changed = false;
			puzzleSolved = true;

			for (int i = 0; i < 81; i++) {
				boolean temp = cells[i / 9][i % 9].update(this);
				puzzleSolved = puzzleSolved && temp;
			}
			loops++;

		}
		System.err.println("SOLVED? " + puzzleSolved + "(loops:" + loops + ")");

		if (!checkValid()) {
			System.err.println("REVERTING");
			this.cells = backupPuzzle.cells.clone();
			if (failedGuesses.containsKey(guessCellIndex)) {
				failedGuesses.get(guessCellIndex).add(guessAnswer);
			} else {
				ArrayList<Integer> tempValues = new ArrayList<Integer>();
				tempValues.add(guessAnswer);
				failedGuesses.put(guessCellIndex, tempValues);
			}
			int column = Cell.getColumn(guessCellIndex);
			int row = Cell.getRow(guessCellIndex);
			this.cells[row][column].excludeSolution(guessAnswer);
		}
		if (!puzzleSolved) {
			guess();
		}

	}

	public void guess() {
		System.err.println("GUESSING");

		backupPuzzle = new Puzzle(this);

		ArrayList<Integer> almostIndices = getAlmostSolvedIndices(2);
		for (int i = 0; i < almostIndices.size(); i++) {
			int index = almostIndices.get(i);
			int row = Cell.getRow(index);
			int column = Cell.getColumn(index);
			Cell temp = cells[row][column];
			guessCellIndex = index;
			for (int j = 0; j < temp.getPossibleSolutions().size(); j++) {

				guessAnswer = temp.getPossibleSolutions().get(j);
				if (failedGuesses.containsKey(guessCellIndex)
						&& failedGuesses.get(guessCellIndex).contains(
								guessAnswer)) {
					continue;
				}

				cells[row][column].setAnswer(guessAnswer);

				solve();

			}

		}

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

		for (int i = 0; i < 81; i++) {
			int row = Cell.getRow(i);
			int column = Cell.getColumn(i);
			Cell temp = cells[row][column];
			if (!temp.getIsSolved()) {
				if (temp.getPossibleSolutions().size() <= maxSolutions) {
					almost.add(i);
				}

			}
		}

		return almost;
	}

	public int getNumberSolved() {
		int count = 0;
		for (int i = 0; i < 81; i++) {
			int row = Cell.getRow(i);
			int column = Cell.getColumn(i);
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
