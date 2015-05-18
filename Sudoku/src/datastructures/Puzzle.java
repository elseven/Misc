package datastructures;

import java.util.ArrayList;
import java.util.Scanner;

import main.Driver;

public class Puzzle {
	public Cell[][] cells = new Cell[9][9];
	public static Scanner scanner = new Scanner(System.in);

	public static boolean changed = false;

	// private static int maxLoopCount = 1000;

	/**
	 * Copy constructor. Copy cells from another puzzle to this one.
	 * 
	 * @param other
	 *            the puzzle to copy.
	 */
	public Puzzle(Puzzle other) {
		copyPuzzle(other);
	}

	public Puzzle(String input) {
		for (int i = 0; i < 81; i++) {
			cells[i / 9][i % 9] = new Cell(i, input.charAt(i));
		}
	}

	public void copyPuzzle(Puzzle other) {
		for (int i = 0; i < 81; i++) {
			this.cells[Cell.getRow(i)][Cell.getColumn(i)] = new Cell(
					other.cells[Cell.getRow(i)][Cell.getColumn(i)]);
		}
	}

	public boolean run() {

		solve();

		if (!getPuzzleIsSolved()) {
			System.out.println(this);
			System.out.println(">>>>>>>>>>>>>>>START GUESS<<<<<<<<<<<<<<<<");
			guess();
		}

		if (getPuzzleIsSolved()) {

			System.out
					.println("******************************************************");
			System.out
					.println("**********************ANSWER:*************************");
			System.out
					.println("******************************************************");
			System.out.println(this);
			return true;

		} else {
			System.out
					.println("??????????????????????????????????????????????????????");
			System.out
					.println("??????????????????????????????????????????????????????");
			System.out.println("IMPOSSIBLE!!!");
			System.out
					.println("??????????????????????????????????????????????????????");
			System.out
					.println("??????????????????????????????????????????????????????");
			return false;

		}

	}

	public boolean getPuzzleIsSolved() {
		return (getNumberSolved() == 81);
	}

	public void solve() { // int loops = 0;

		changed = true;
		// while (!puzzleSolved && changed && loops < maxLoopCount) {
		while (!getPuzzleIsSolved() && changed) {
			changed = false;

			for (int i = 0; i < 81; i++) {
				updateCellAt(i);
			}

		}

	}

	private Cell getCellAt(int index) {
		int row = Cell.getRow(index);
		int column = Cell.getColumn(index);
		return this.cells[row][column];
	}

	public boolean updateCellAt(int index) {

		return rowOverlap(index) || columnOverlap(index)
				|| squareOverlap(index) || combinedOverlap(index)
				|| nakedTwins(index);

	}

	private boolean refreshPossibleSolutions(int index) {

		Cell cell = getCellAt(index);

		if (cell.getIsSolved()) {

			return true;
		}

		int row = Cell.getRow(index);
		int column = Cell.getColumn(index);
		int square = Cell.getSquare(index);
		Cell other = null;
		// for each cell in the same row
		for (int i = 0; i < 9; i++) {
			other = this.cells[row][i];
			if (other.getIsSolved()) {
				if (cell.getPossibleSolutions().contains(other.getAnswer())) {
					cell.excludePossibleSolution(other.getAnswer());
					Puzzle.changed = true;
				}
			}
		}

		// for each cell in the same column
		for (int i = 0; i < 9; i++) {
			other = this.cells[i][column];
			if (other.getIsSolved()) {
				if (cell.getPossibleSolutions().contains(other.getAnswer())) {
					cell.excludePossibleSolution(other.getAnswer());
					Puzzle.changed = true;
				}
			}
		}

		// for each cell in the same square
		for (int i = 0; i < 81; i++) {
			if (Cell.getSquare(i) == square) {
				int tempRow = Cell.getRow(i);
				int tempColumn = Cell.getColumn(i);
				other = this.cells[tempRow][tempColumn];
				if (other.getIsSolved()) {
					if (cell.getPossibleSolutions().contains(other.getAnswer())) {

						cell.excludePossibleSolution(other.getAnswer());

						Puzzle.changed = true;
					}
				}

			}
		}

		if (cell.getPossibleSolutions().size() == 1) {
			cell.setAnswer(cell.getPossibleSolutions().get(0));
		}

		return cell.getPossibleSolutions().isEmpty();

	}

	/**
	 * two squares in the same unit that both have the same two possible digits.
	 * Given {'A5': '26', 'A6':'26', ...}, we can conclude that 2 and 6 must be
	 * in A5 and A6 (although we don't know which is where), and we can
	 * therefore eliminate 2 and 6 from every other square in the A row unit.
	 */
	private boolean nakedTwins(int index) {
		return nakedTwinsColumn(index) || nakedTwinsRow(index)
				|| nakedTwinsSquare(index);
	}

	private boolean nakedTwinsColumn(int index) {
		Cell cell = getCellAt(index);

		if (cell.getIsSolved()) {
			return true;
		}

		int row = Cell.getRow(index);
		int column = Cell.getColumn(index);
		Cell other = null;

		refreshPossibleSolutions(index);

		if (cell.getPossibleSolutions().size() == 2) {

			// for each cell in the same column
			for (int i = 0; i < 9; i++) {
				if (i == row) {
					continue;
				}
				other = this.cells[i][column];

				if (!other.getIsSolved()
						&& other.getPossibleSolutions().size() == 2) {
					if (other.getPossibleSolutions().containsAll(
							cell.getPossibleSolutions())) {
						for (int j = 0; j < 9; j++) {
							if (j == row || j == i) {
								continue;
							}
							Cell temp = this.cells[j][column];
							if (!temp.getIsSolved()) {
								temp.excludePossibleSolution(cell
										.getPossibleSolutions().get(0));
								temp.excludePossibleSolution(cell
										.getPossibleSolutions().get(1));
							}

						}

					}

				}

			}
		}

		return cell.getPossibleSolutions().isEmpty();
	}

	private boolean nakedTwinsRow(int index) {
		Cell cell = getCellAt(index);

		if (cell.getIsSolved()) {
			return true;
		}

		int row = Cell.getRow(index);
		int column = Cell.getColumn(index);
		Cell other = null;

		refreshPossibleSolutions(index);

		if (cell.getPossibleSolutions().size() == 2) {

			// for each cell in the same column
			for (int i = 0; i < 9; i++) {
				if (i == column) {
					continue;
				}
				other = this.cells[row][i];

				if (!other.getIsSolved()
						&& other.getPossibleSolutions().size() == 2) {
					if (other.getPossibleSolutions().containsAll(
							cell.getPossibleSolutions())) {
						for (int j = 0; j < 9; j++) {
							if (j == column || j == i) {
								continue;
							}
							Cell temp = this.cells[row][j];
							if (!temp.getIsSolved()) {
								temp.excludePossibleSolution(cell
										.getPossibleSolutions().get(0));
								temp.excludePossibleSolution(cell
										.getPossibleSolutions().get(1));
							}

						}

					}

				}

			}
		}

		return cell.getPossibleSolutions().isEmpty();
	}

	private boolean nakedTwinsSquare(int index) {
		Cell cell = getCellAt(index);

		if (cell.getIsSolved()) {
			return true;
		}

		int square = Cell.getSquare(index);
		Cell other = null;
		refreshPossibleSolutions(index);

		if (cell.getPossibleSolutions().size() == 2) {

			for (int i = 0; i < 81; i++) {
				if (Cell.getSquare(i) == square) {
					int otherRow = Cell.getRow(i);
					int otherColumn = Cell.getColumn(i);

					if (i == index) {
						continue;
					}
					other = this.cells[otherRow][otherColumn];

					if (!other.getIsSolved()
							&& other.getPossibleSolutions().size() == 2) {
						if (other.getPossibleSolutions().containsAll(
								cell.getPossibleSolutions())) {

							for (int j = 0; j < 81; j++) {
								int tempSquare = Cell.getSquare(j);
								int tempRow = Cell.getRow(j);
								int tempColumn = Cell.getColumn(j);
								if (tempSquare != square || j == index
										|| j == i) {
									continue;
								}
								Cell temp = this.cells[tempRow][tempColumn];
								if (!temp.getIsSolved()) {
									temp.excludePossibleSolution(cell
											.getPossibleSolutions().get(0));
									temp.excludePossibleSolution(cell
											.getPossibleSolutions().get(1));
								}

							}
						}
					}
				}

			}
		}
		return cell.getPossibleSolutions().isEmpty();
	}

	private boolean combinedOverlap(int index) {
		Cell cell = getCellAt(index);

		if (cell.getIsSolved()) {
			return true;
		}

		int row = Cell.getRow(index);
		int column = Cell.getColumn(index);
		int square = Cell.getSquare(index);
		Cell other = null;
		refreshPossibleSolutions(index);

		ArrayList<Integer> uniquePossibleSolutions = new ArrayList<Integer>();

		for (Integer sol : cell.getPossibleSolutions()) {
			uniquePossibleSolutions.add(sol);
		}

		// for each cell in the same column
		for (int i = 0; i < 9; i++) {
			if (i == row) {
				continue;
			}
			other = this.cells[i][column];

			if (!other.getIsSolved()) {
				for (Integer sol : other.getPossibleSolutions()) {
					int tempIndex = uniquePossibleSolutions.indexOf(sol);
					if (tempIndex >= 0) {
						uniquePossibleSolutions.remove(tempIndex);
					}
				}

			}

		}

		// for each cell in the same row
		for (int i = 0; i < 9; i++) {
			// if the other cell is not solved, compare the possible solutions
			if (i == column) {
				continue;
			}
			other = this.cells[row][i];
			if (!other.getIsSolved()) {
				for (Integer sol : other.getPossibleSolutions()) {
					int tempIndex = uniquePossibleSolutions.indexOf(sol);
					if (tempIndex >= 0) {
						uniquePossibleSolutions.remove(tempIndex);
					}
				}

			}
		}

		// for each cell in the same square
		for (int i = 0; i < 81; i++) {
			if (Cell.getSquare(i) == square) {
				int tempRow = Cell.getRow(i);
				int tempColumn = Cell.getColumn(i);
				if (tempRow == row && tempColumn == column) {
					continue;
				}
				other = this.cells[tempRow][tempColumn];

				if (!other.getIsSolved()) {
					for (Integer sol : other.getPossibleSolutions()) {
						int tempIndex = uniquePossibleSolutions.indexOf(sol);
						if (tempIndex >= 0) {
							uniquePossibleSolutions.remove(tempIndex);
						}
					}
				}
			}
		}

		if (uniquePossibleSolutions.size() == 1) {
			cell.setAnswer(uniquePossibleSolutions.get(0));
		}
		return cell.getPossibleSolutions().isEmpty();

	}

	/**
	 * 
	 * @param puzzle
	 * @return
	 */
	private boolean columnOverlap(int index) {
		Cell cell = getCellAt(index);

		if (cell.getIsSolved()) {
			return true;
		}

		int row = Cell.getRow(index);
		int column = Cell.getColumn(index);
		Cell other = null;
		refreshPossibleSolutions(index);

		ArrayList<Integer> uniquePossibleSolutions = new ArrayList<Integer>();

		for (Integer sol : cell.getPossibleSolutions()) {
			uniquePossibleSolutions.add(sol);
		}

		// for each cell in the same column
		for (int i = 0; i < 9; i++) {
			if (i == row) {
				continue;
			}
			other = this.cells[i][column];

			if (!other.getIsSolved()) {
				for (Integer sol : other.getPossibleSolutions()) {
					int tempIndex = uniquePossibleSolutions.indexOf(sol);
					if (tempIndex >= 0) {
						uniquePossibleSolutions.remove(tempIndex);
					}
				}

			}

		}

		if (uniquePossibleSolutions.size() == 1) {
			cell.setAnswer(uniquePossibleSolutions.get(0));
		}
		return cell.getPossibleSolutions().isEmpty();
	}

	private boolean rowOverlap(int index) {
		Cell cell = getCellAt(index);

		if (cell.getIsSolved()) {
			return true;
		}

		int row = Cell.getRow(index);
		int column = Cell.getColumn(index);
		Cell other = null;

		refreshPossibleSolutions(index);

		ArrayList<Integer> uniquePossibleSolutions = new ArrayList<Integer>();

		for (Integer sol : cell.getPossibleSolutions()) {
			uniquePossibleSolutions.add(sol);
		}

		// for each cell in the same row
		for (int i = 0; i < 9; i++) {
			// if the other cell is not solved, compare the possible solutions
			if (i == column) {
				continue;
			}
			other = this.cells[row][i];
			if (!other.getIsSolved()) {

				for (Integer sol : other.getPossibleSolutions()) {
					int tempIndex = uniquePossibleSolutions.indexOf(sol);

					if (tempIndex >= 0) {

						uniquePossibleSolutions.remove(tempIndex);

					}
				}

			}
		}

		if (uniquePossibleSolutions.size() == 1) {
			cell.setAnswer(uniquePossibleSolutions.get(0));
		}
		return cell.getPossibleSolutions().isEmpty();
	}

	private boolean squareOverlap(int index) {
		Cell cell = getCellAt(index);

		if (cell.getIsSolved()) {
			return true;
		}

		int row = Cell.getRow(index);
		int column = Cell.getColumn(index);
		int square = Cell.getSquare(index);
		Cell other = null;
		refreshPossibleSolutions(index);

		ArrayList<Integer> uniquePossibleSolutions = new ArrayList<Integer>();

		for (Integer sol : cell.getPossibleSolutions()) {
			uniquePossibleSolutions.add(sol);
		}
		// for each cell in the same square
		for (int i = 0; i < 81; i++) {
			if (Cell.getSquare(i) == square) {
				int tempRow = Cell.getRow(i);
				int tempColumn = Cell.getColumn(i);
				if (tempRow == row && tempColumn == column) {
					continue;
				}
				other = this.cells[tempRow][tempColumn];

				if (!other.getIsSolved()) {
					for (Integer sol : other.getPossibleSolutions()) {
						int tempIndex = uniquePossibleSolutions.indexOf(sol);
						if (tempIndex >= 0) {
							uniquePossibleSolutions.remove(tempIndex);
						}
					}
				}
			}
		}

		if (uniquePossibleSolutions.size() == 1) {
			cell.setAnswer(uniquePossibleSolutions.get(0));
		}
		return cell.getPossibleSolutions().isEmpty();
	}

	// ===============================================================//
	private void guess() {
		Puzzle backupPuzzle = new Puzzle(this);
		guessNext(backupPuzzle);

	}

	private boolean guessNext(Puzzle previousPuzzle) {

		if (getPuzzleIsSolved()) {
			return true;
		}
		Puzzle preGuessPuzzle = new Puzzle(this);

		Cell temp = null;
		Cell tempCopy = null;
		int row = -1;
		int column = -1;
		int index = -1;
		// find the first unsolved cell
		for (int i = 0; i < 81; i++) {
			index = i;
			row = Cell.getRow(i);
			column = Cell.getColumn(i);
			temp = this.cells[row][column];
			tempCopy = new Cell(temp);
			if (!temp.getIsSolved()) {
				break;
			}
		}

		// Puzzle tempPuzzle = new Puzzle(this);
		boolean containsValidSoution = false;

		// try each guess for the current cell
		for (Integer possibleAnswer : tempCopy.getPossibleSolutions()) {
			if (Driver.debug) {
				System.out.println("GUESSING:\t" + index + "\t("
						+ possibleAnswer + ")");
			}

			temp = this.cells[row][column];

			if (!temp.setAnswer(possibleAnswer)) {
				if (Driver.debug) {
					System.out.println("???");
				}

				revert(preGuessPuzzle);
				temp.setAnswer(possibleAnswer);
				return false;

			}
			solve();
			Puzzle currentPuzzle = new Puzzle(this);

			if (getPuzzleIsSolved()) {
				return true;
			}

			// if current guess doesn't cause problems, attempt next guess
			if (checkValid()) {
				if (Driver.debug) {
					System.out.println("VALID?");
					System.out.println(this);
				}

				containsValidSoution = true;

				// if the next guess works
				if (guessNext(currentPuzzle)) {

					// if the puzzle is solved, quit
					if (getPuzzleIsSolved()) {
						return true;
					}

					// return false;
				} else {
					/*
					 * if none of the guesses in the next round worked, but this
					 * guess didn't immediately fail, revert to before any
					 * guesses
					 */
					revert(preGuessPuzzle);

				}

			} else {
				if (Driver.debug) {

					System.out
							.println("\n=====================================\n"
									+ "PREVIOUS1 REVERT!");
				}
				/*
				 * if the guess didn't work, go on to the next possible solution
				 * for this cell
				 */
				revert(previousPuzzle);

			}// END IF-ELSE [CHECK VALID]

		}// END FOR EACH SOLUTION

		if (!containsValidSoution) {
			if (Driver.debug) {
				System.out.println("PREVIOUS2 REVERT");
			}

			revert(previousPuzzle);

			return false;

		}

		return true;
	}

	private void revert(Puzzle other) {
		if (getPuzzleIsSolved()) {
			System.out.println("REVERT ATTEMPT THWARTED! ALREADY SOLVED");
			return;
		}
		if (Driver.debug) {

			System.out.println("************reverting*****************");
			System.out.println("Pre:\n");
			System.out.println(this);
		}
		this.copyPuzzle(other);
		if (Driver.debug) {
			System.out.println("POST:");
			System.out.println(this);
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

			if (this.cells[row][column].getIsSolved()) {
				count++;
			}
		}

		return count;

	}

	@Override
	public String toString() {
		String s = "\n\n";
		s += "|============================================"
				+ "======================================="
				+ "======================================="
				+ "======================================="
				+ "==========================" + "|\n|";
		for (int i = 0; i < 9; i++) {
			for (int j = 0; j < 9; j++) {

				Cell cell = cells[i][j];
				int size = cell.getPossibleSolutions().size();
				if (cell.getIsSolved()) {
					s += "         " + cell.getAnswer() + "          ";
				} else if (size == 0) {
					s += s += "         ?          ";
				} else {
					for (int extraSpace = 0; extraSpace < (9 - cells[i][j]
							.getPossibleSolutions().size()); extraSpace++) {
						s += " ";
					}

					s += "[";
					for (int ansIndex = 0; ansIndex < size; ansIndex++) {
						s += cell.getPossibleSolutions().get(ansIndex);
						if (ansIndex < size - 1) {
							s += ",";
						}

					}
					s += "]";
					for (int extraSpace = 0; extraSpace < (9 - cells[i][j]
							.getPossibleSolutions().size()); extraSpace++) {
						s += " ";
					}
					s += " ";
				}

				if (j % 3 == 2) {
					s += " | ";
				}
			}
			s += "\n|";
			if (i % 3 == 2) {
				s += "============================================"
						+ "======================================="
						+ "======================================="
						+ "=========================="
						+ "=======================================|\n|";
			}

		}
		return s;
	}

}
