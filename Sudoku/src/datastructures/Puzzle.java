package datastructures;

import java.util.ArrayList;
import java.util.HashMap;
import java.util.Scanner;

public class Puzzle {
	public Cell[][] cells = new Cell[9][9];
	public static Scanner scanner = new Scanner(System.in);
	public static boolean changed = false;
	public static Puzzle backupPuzzle = null;
	public static int guessCellIndex = -1;
	public static int guessAnswer = -1;
	public static boolean guessingHasStarted = false;
	private static int maxLoopCount = 500;

	public static HashMap<Integer, ArrayList<Integer>> currentGuesses = new HashMap<Integer, ArrayList<Integer>>();
	public static HashMap<Integer, ArrayList<Integer>> possibleGuesses = new HashMap<Integer, ArrayList<Integer>>();

	public static ArrayList<Integer> rootGuesses = new ArrayList<Integer>();
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

		solve();
		printPossibleStuff();
		while (this.getNumberSolved() < 81) {
			solve();

			// System.out.println("Solved: " + this.getNumberSolved());
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
		System.out.println(this);

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
		System.out.println(this);

	}

	private void excludeMostRecentUnexhausted() {
		int index = getMostRecentUnexhausted();

		// System.out.println("LEFT OFF INDEX: " + index);

		ArrayList<Integer> failedGuesses = new ArrayList<Integer>();
		for (Integer temp : currentGuesses.get(index)) {
			failedGuesses.add(temp);
		}
		currentGuesses.clear();
		for (Integer failed : failedGuesses) {
			addToCurrentSolution(index, failed);
			exclude(index, failed);
		}
		backupPuzzle = new Puzzle(this);
	}

	private int getMostRecentUnexhausted() {

		for (int i = 0; i < currentGuesses.size(); i++) {
			int index = (int) currentGuesses.keySet().toArray()[i];

			if (currentGuesses.get(index).size() < possibleGuesses.get(index)
					.size()) {
				return index;
			}

		}
		return -1;

	}

	private void addToCurrentSolution(int index, int possibleAnswer) {
		if (currentGuesses.containsKey(index)) {
			if (currentGuesses.get(index).indexOf(possibleAnswer) < 0) {
				currentGuesses.get(index).add(possibleAnswer);
			}

		} else {
			ArrayList<Integer> tempList = new ArrayList<Integer>();
			tempList.add(possibleAnswer);
			currentGuesses.put(index, tempList);

		}
	}

	private void storeAllPossibleAnswers() {

		possibleGuesses.clear();
		for (int i = 0; i < 81; i++) {
			int row = Cell.getRow(i);
			int column = Cell.getColumn(i);
			Cell temp = this.cells[row][column];
			if (!temp.getIsSolved()) {
				ArrayList<Integer> tempList = new ArrayList<Integer>();
				for (Integer possible : temp.getPossibleSolutions()) {
					tempList.add(possible);
				}
				possibleGuesses.put(i, tempList);

			}
		}

	}

	private void guess() {
		backupPuzzle = new Puzzle(this);
		storeAllPossibleAnswers();
		guessNext();

	}

	private boolean guessNext() {
		// System.out.println("PREV GUESS: " + prevIndex + ": " + prevGuess);
		if (getNumberSolved() == 81) {
			Puzzle.puzzleSolved = true;
			return true;
		}

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

		boolean containsValidSoution = false;

		for (Integer possibleAnswer : tempCopy.getPossibleSolutions()) {
			temp = this.cells[row][column];
			System.out.println("CURRENT GUESS: " + index + ": "
					+ possibleAnswer + "\t" + temp.getPossibleSolutions());
			Puzzle tempPuzzle = new Puzzle(this);
			System.out.println("guessing index: " + index);
			addToCurrentSolution(index, possibleAnswer);

			if (!temp.setAnswer(possibleAnswer)) {

				continue;

			}
			solve();
			System.out.println(this);
			if (getNumberSolved() == 81) {
				Puzzle.puzzleSolved = true;
				return true;
			}
			if (checkValid()) {
				System.out.println("VALID?");

				containsValidSoution = true;
				if (guessNext()) {
					break;
				} else {
					// return false;

					revert(tempPuzzle);
					this.printPossibleStuff();
					System.out.println("???EXCLUDE: " + possibleAnswer);
					exclude(index, possibleAnswer);

					// continue

				}

			} else {
				// this.printPossibleStuff();
				System.out.println("=======================================");
				revert(tempPuzzle);
				// exclude(index, possibleAnswer);
				// this.printPossibleStuff();
				System.out.println("CURRENT GUESSES: " + currentGuesses);
				System.out.println("=======================================");
				System.out.println("***EXCLUDE: " + possibleAnswer);
				// temp.excludeSolution(possibleAnswer);
				exclude(index, possibleAnswer);
				System.out.println("=======================================");
				this.printPossibleStuff();
			}

		}

		if (!containsValidSoution) {
			System.out.println(">>>>>>>>>>>no valid solution for index: "
					+ index + "<<<<<<<<<<<<");
			revert(backupPuzzle);
			// TODO: NEED TO FIGURE OUT HOW TO REVERT TO MOST RECENT UNEXHAUSTED
			excludeMostRecentUnexhausted();
			guessNext();

		}

		return false;
	}

	private void exclude(int index, int ans) {
		// TODO: IMPLEMENT
		System.out.println("EXCLUDING FROM INDEX: " + index + ":\t" + ans);
		int row = Cell.getRow(index);
		int column = Cell.getColumn(index);
		Cell temp = this.cells[row][column];
		temp.excludeSolution(ans);
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
