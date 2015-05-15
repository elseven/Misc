package datastructures;

import java.util.ArrayList;
import java.util.HashMap;
import java.util.Scanner;

public class Puzzle {
	public Cell[][] cells = new Cell[9][9];
	public static Scanner scanner = new Scanner(System.in);
	public static boolean changed = false;
	// public static Puzzle backupPuzzle = null;
	public static int guessCellIndex = -1;
	public static int guessAnswer = -1;
	public static boolean guessingHasStarted = false;
	private static int maxLoopCount = 500;
	// public static HashMap<Integer, ArrayList<Integer>> badGuesses = new
	// HashMap<Integer, ArrayList<Integer>>();
	public static HashMap<Integer, ArrayList<Integer>> excludedGuesses = new HashMap<Integer, ArrayList<Integer>>();
	public static HashMap<Integer, ArrayList<Integer>> currentGuesses = new HashMap<Integer, ArrayList<Integer>>();

	public static ArrayList<Integer> rootGuesses = new ArrayList<Integer>();
	public static int guessCount = 0;
	private static boolean puzzleSolved = false;
	public static int rootIndex = -1;

	// private static ArrayList<>

	// private static Stack<Puzzle> history = new Stack<Puzzle>();

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
		// backupPuzzle = new Puzzle(this);

		// TODO: CHANGE TO 81
		while (true) {
			solve();

			System.out.println("Solved: " + this.getNumberSolved());
			if (this.getNumberSolved() == 81) {
				break;
			}
			guess();

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
		// System.out.println(this);

		puzzleSolved = false;
		int loops = 0;

		changed = true;
		while (!puzzleSolved && changed && loops < maxLoopCount) {
			changed = false;
			puzzleSolved = true;

			for (int i = 0; i < 81; i++) {
				boolean temp = cells[i / 9][i % 9].update(this);
				puzzleSolved = puzzleSolved && temp;
			}
			loops++;
		}

		System.out.println("(solved: " + getNumberSolved() + ")");
		// System.out.println(this);

	}

	private void guess() {

		guessRoot();
	}

	private void guessRoot() {
		System.out.println("GUESSING ROOT");
		Puzzle noGuessBackup = new Puzzle(this);
		Cell temp = null;
		Cell tempCopy = null;
		int index = -1;

		// find the first unsolved cell
		for (int i = 0; i < 81; i++) {

			rootGuesses.clear();
			int row = Cell.getRow(i);
			int column = Cell.getColumn(i);
			temp = this.cells[row][column];
			tempCopy = new Cell(temp);
			if (!temp.getIsSolved()) {
				index = i;
				break;
			}
		}

		for (Integer possibleAnswer : tempCopy.getPossibleSolutions()) {
			rootGuesses.add(possibleAnswer);
			temp.setAnswer(possibleAnswer);
			solve();
			if (getNumberSolved() == 81) {
				Puzzle.puzzleSolved = true;
				return;
			}
			if (checkValid()) {
				currentGuesses.clear();
				ArrayList<Integer> tempList = new ArrayList<Integer>();
				tempList.add(possibleAnswer);
				currentGuesses.put(index, tempList);

				// check if any solution will work with current root guess
				if (guessLeaf()) {
					// TODO: IMPL

				} else {
					revert(noGuessBackup);
					temp.excludeSolution(possibleAnswer);
				}

			} else {
				revert(noGuessBackup);

			}

		}

	}

	private boolean guessLeaf() {
		System.out.println("CURRENT GUESS: " + currentGuesses);
		Puzzle guessBackup = new Puzzle(this);
		Cell temp = null;
		Cell tempCopy = null;
		int index = -1;

		// find the first unsolved cell
		for (int i = 0; i < 81; i++) {

			int row = Cell.getRow(i);
			int column = Cell.getColumn(i);
			temp = this.cells[row][column];
			tempCopy = new Cell(temp);
			if (!temp.getIsSolved()) {
				index = i;
				break;
			}
		}

		boolean containsValidSoution = false;

		for (Integer possibleAnswer : tempCopy.getPossibleSolutions()) {
			Puzzle tempPuzzle = new Puzzle(this);

			temp.setAnswer(possibleAnswer);
			solve();
			if (getNumberSolved() == 81) {
				Puzzle.puzzleSolved = true;
				return true;
			}
			if (checkValid()) {

				ArrayList<Integer> tempList = new ArrayList<Integer>();
				tempList.add(possibleAnswer);
				currentGuesses.put(index, tempList);
				guessLeaf();
				containsValidSoution = true;

			} else {
				revert(tempPuzzle);
				// exclude(index, possibleAnswer);
				temp.excludeSolution(possibleAnswer);

			}

		}

		return !containsValidSoution;

	}

	private void exclude(int index, int ans) {
		// TODO: IMPLEMENT
	}

	private int getNextUnguessedIndex() {
		for (int i = 0; i < 81; i++) {
			int row = Cell.getRow(i);
			int column = Cell.getColumn(i);
			Cell temp = this.cells[row][column];
			if (!temp.getIsSolved()) {
				return i;
			}
		}
		return -1;
	}

	private void revert(Puzzle other) {
		System.out.println("************reverting*****************");
		this.copyPuzzle(other);
	}

	private void revertCell(Cell revert) {
		int index = revert.getIndex();
		int row = Cell.getRow(index);
		int column = Cell.getColumn(index);
		this.cells[row][column] = new Cell(revert);
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
