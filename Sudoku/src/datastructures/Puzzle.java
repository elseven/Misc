package datastructures;

import java.util.ArrayList;
import java.util.HashMap;

public class Puzzle {
	public Cell[][] cells = new Cell[9][9];

	public static boolean changed = false;
	public static Puzzle backupPuzzle = null;
	public static int guessCellIndex = -1;
	public static int guessAnswer = -1;
	public static boolean guessingHasStarted = false;
	public static HashMap<Integer, ArrayList<Integer>> badGuesses = new HashMap<Integer, ArrayList<Integer>>();
	public static HashMap<Integer, ArrayList<Integer>> currentGuesses = new HashMap<Integer, ArrayList<Integer>>();
	public static int guessCount = 0;
	private static boolean puzzleSolved = false;

	public Puzzle(Puzzle other) {
		copyPuzzle(other);
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

	public void copyPuzzle(Puzzle other) {
		for (int i = 0; i < 81; i++) {
			this.cells[i / 9][i % 9] = new Cell(other.cells[i / 9][i % 9]);
		}
	}

	public void run() {
		backupPuzzle = new Puzzle(this);

		// TODO: CHANGE TO 81
		while (this.getNumberSolved() < 81) {
			solve();

			System.out.println("Solved: " + this.getNumberSolved());

			if (!puzzleSolved) {
				if (!guessingHasStarted) {
					backupPuzzle = new Puzzle(this);
				}
				guessingHasStarted = true;
				guess();
			}
		}
		System.out
				.println("******************************************************");
		System.out
				.println("**********************ANSWER:*************************");
		System.out
				.println("******************************************************");
		System.out.println(this);
	}

	public void solve() {
		System.out.println("*************SOLVING*********************");
		System.out.println(this);
		// System.out.println("Possible: ");
		// this.printPossibleStuff();

		puzzleSolved = false;
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
		if (!guessingHasStarted) {
			backupPuzzle = new Puzzle(this);
		}
		System.out.println("(solved: " + getNumberSolved() + ")");

	}

	private void addBadGuess(int index, int ans) {

		if (badGuesses.containsKey(index)) {
			if (!badGuesses.get(index).contains(ans)) {
				badGuesses.get(index).add(ans);
			}
		} else {

			ArrayList<Integer> temp = new ArrayList<Integer>();
			temp.add(ans);
			badGuesses.put(index, temp);
		}

	}

	private boolean isBadGuess(int index, int ans) {

		return badGuesses.containsKey(index)
				&& (badGuesses.get(index).contains(ans));

	}

	private boolean hasBeenGuessed(int index, int ans) {
		boolean exhausted = false;

		if (currentGuesses.containsKey(index)) {
			if (currentGuesses.get(index).contains(ans)) {
				exhausted = true;
			} else {
				currentGuesses.get(index).add(ans);
			}
		} else {
			exhausted = false;
			ArrayList<Integer> temp = new ArrayList<Integer>();
			temp.add(ans);
			currentGuesses.put(index, temp);
		}
		if (isBadGuess(index, ans)) {
			exhausted = true;
		}

		return exhausted;

	}

	public void guess() {
		System.out.println("GUESSING");
		ArrayList<Integer> unsolved = getUnsolvedIndices();
		for (int i = 0; i < unsolved.size(); i++) {

			int index = unsolved.get(i);

			int row = Cell.getRow(index);
			int column = Cell.getColumn(index);
			Cell tempCell = cells[row][column];
			// System.out.println("***" + "***");

			ArrayList<Integer> possibleAnswers = new ArrayList<Integer>();
			for (Integer p : tempCell.getPossibleSolutions()) {
				possibleAnswers.add(p);
			}
			guessCellIndex = index;

			for (Integer possible : possibleAnswers) {
				System.out.println("guessing: " + row + "," + column + "\t"
						+ possibleAnswers + "[" + possible + "]");

				guessAnswer = possible;
				// TODO: SKIP IF ALREADY IN GUESSES
				if (hasBeenGuessed(index, possible)) {
					return;
				}
				this.cells[row][column].setAnswer(possible);

				// attempt to solve with this cell changed
				solve();
				/*
				 * if the last guess was bad, revert and remove from possible
				 * answers
				 */
				if (checkValid()) {
					backupPuzzle = new Puzzle(this);
				} else {
					revert();
					return;
				}
			}

		}
	}

	private void revert() {
		System.err.println("REVERTING");
		this.copyPuzzle(backupPuzzle);
		// TODO: FIGURE OUT HOW TO KEEP TRACK OF BAD GUESSES?
		// MOST RECENT? FIRST AFTER REVERT?
		addBadGuess(guessCellIndex, guessAnswer);
		String badString = "Bad:\n";
		for (Integer key : badGuesses.keySet()) {
			badString += key + "[";
			for (Integer value : badGuesses.get(key)) {
				badString += value + " ";
			}
			badString += "]";
		}
		System.err.println(badString);

		currentGuesses.clear();
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

		if (isValid) {
			// TODO: IMPLEMENT OTHER CHECK
			for (int i = 0; i < 81; i++) {
				int row = Cell.getRow(i);
				int column = Cell.getColumn(i);
				Cell tempCell = cells[row][column];
				if (!tempCell.getIsSolved()
						&& tempCell.getPossibleSolutions().isEmpty()) {
					isValid = false;
					break;
				}

			}

		}

		return isValid;
	}

	private ArrayList<Integer> getUnsolvedIndices() {
		ArrayList<Integer> unsolved = new ArrayList<Integer>();
		for (int i = 0; i < 81; i++) {
			int row = Cell.getRow(i);
			int column = Cell.getColumn(i);
			Cell temp = cells[row][column];
			if (!temp.getIsSolved()) {
				unsolved.add(i);
			}
		}
		return unsolved;
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
		// System.out.println("solved: " + count);
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
				s += "\n";
			}
		}
		return s;
	}

}
