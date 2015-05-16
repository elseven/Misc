package datastructures;

import java.util.ArrayList;
import java.util.HashMap;
import java.util.Scanner;

import main.Driver;

public class Puzzle {
	public Cell[][] cells = new Cell[9][9];
	public static Scanner scanner = new Scanner(System.in);

	public static boolean changed = false;
	// public static Puzzle backupPuzzle = null;
	public static int guessCellIndex = -1;
	public static int guessAnswer = -1;
	public static boolean guessingHasStarted = false;
	private static int maxLoopCount = 500;

	public static HashMap<Integer, ArrayList<Integer>> currentGuesses = new HashMap<Integer, ArrayList<Integer>>(
			81);
	public static HashMap<Integer, ArrayList<Integer>> possibleGuesses = new HashMap<Integer, ArrayList<Integer>>(
			81);

	public static int guessCount = 0;
	private static boolean puzzleSolved = false;
	public static int rootIndex = -1;

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
				Driver.errOut.println(temp.getPossibleStuff(this));
			}

		}
	}

	public void copyPuzzle(Puzzle other) {
		for (int i = 0; i < 81; i++) {
			this.cells[i / 9][i % 9] = new Cell(other.cells[i / 9][i % 9]);
		}
	}

	public void run() {

		solve();
		printPossibleStuff();
		while (this.getNumberSolved() < 81) {
			solve();

			// Driver.errOut.println("Solved: " + this.getNumberSolved());
			if (this.getNumberSolved() == 81) {
				break;
			}
			guess();

		}
		Driver.errOut
				.println("******************************************************");
		Driver.errOut
				.println("**********************ANSWER:*************************");
		Driver.errOut
				.println("******************************************************");
		Driver.errOut.println(this);
	}

	public void solve() {
		Driver.errOut.println("*************SOLVING*********************");
		Driver.errOut.println(this);

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

		Driver.errOut.println("(solved: " + getNumberSolved() + ")");
		Driver.errOut.println(this);

	}

	private void guess() {
		Puzzle backupPuzzle = new Puzzle(this);

		if (guessNext(backupPuzzle)) {
			System.out.println("SOLVED!");
		} else {
			System.err.println("IMPOSSIBLE!");
		}

	}

	private boolean guessNext(Puzzle previousPuzzle) {

		if (getNumberSolved() == 81) {
			Puzzle.puzzleSolved = true;
			return true;
		}
		Puzzle tempPuzzle = new Puzzle(this);

		Cell temp = null;
		Cell tempCopy = null;
		int index = -1;
		int row = -1;
		int column = -1;
		// find the first unsolved cell
		for (int i = 0; i < 81; i++) {

			row = Cell.getRow(i);
			column = Cell.getColumn(i);
			temp = this.cells[row][column];
			tempCopy = new Cell(temp);
			if (!temp.getIsSolved()) {
				index = i;
				break;
			}
		}
		System.out.print("GUESS (" + index + "):\t"
				+ temp.getPossibleSolutions() + ":\t");
		// Puzzle tempPuzzle = new Puzzle(this);
		boolean containsValidSoution = false;

		// try each guess for the current cell
		for (Integer possibleAnswer : tempCopy.getPossibleSolutions()) {

			temp = this.cells[row][column];
			System.out.println(possibleAnswer);

			if (!temp.setAnswer(possibleAnswer)) {
				System.out.println("???");
				continue;

			}
			solve();

			if (getNumberSolved() == 81) {
				Puzzle.puzzleSolved = true;
				return true;
			}

			// if current guess doesn't cause problems, attempt next guess
			if (checkValid()) {
				System.out.println("VALID?");
				System.out.println(this);

				containsValidSoution = true;

				// if the next guess works
				if (guessNext(previousPuzzle)) {
					System.out.println("return true?:\n" + this);

					// if the puzzle is solved, quit
					if (getNumberSolved() == 81) {
						Puzzle.puzzleSolved = true;
						return true;
					}

					// return false;
				} else {
					/*
					 * if none of the guesses in the next round worked, but this
					 * guess didn't immediately fail, revert to before any
					 * guesses
					 */
					revert(previousPuzzle);
					// this.printPossibleStuff();
					System.out.println("???EXCLUDE: " + index + " "
							+ possibleAnswer);
					// exclude(index, possibleAnswer);

					// continue

				}

			} else {
				System.out.println("=============================");
				System.out.println("temp REVERT!");
				System.out.println("pre:\n" + this);
				/*
				 * if the guess didn't work, go on to the next possible solution
				 * for this cell
				 */
				revert(tempPuzzle);

				// this.printPossibleStuff();
			}// END IF-ELSE [CHECK VALID]

		}// END FOR EACH SOLUTION

		if (!containsValidSoution) {
			System.out.println("PREV REVERT");
			revert(previousPuzzle);

			return false;

		}

		return true;
	}

	private void revert(Puzzle other) {
		if (this.getNumberSolved() == 81) {

			return;
		}
		System.out.println("************reverting*****************");
		this.copyPuzzle(other);
		System.out.println(this);
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

	public int getNumberSolved() {
		int count = 0;
		for (int i = 0; i < 81; i++) {
			int row = Cell.getRow(i);
			int column = Cell.getColumn(i);
			// Driver.errOut.println(row+","+column);
			if (this.cells[row][column].getIsSolved()) {
				count++;
			}
		}
		// Driver.errOut.println("solved: " + count);
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
