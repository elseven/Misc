package datastructures;

import java.util.ArrayList;

public class Cell {

	private boolean isSolved = false;
	private int answer = 0;

	private ArrayList<Integer> possibleSolutions = new ArrayList<>();
	private int index = -1;

	public Cell(Cell other) {
		this.isSolved = other.getIsSolved();
		this.answer = other.getAnswer();
		for (int i = 0; i < other.getPossibleSolutions().size(); i++) {
			this.possibleSolutions.add(other.getPossibleSolutions().get(i));
		}
		this.index = other.getIndex();
	}

	public Cell(int index) {
		this.index = index;
		possibleSolutions.clear();
		for (int i = 1; i < 10; i++) {
			possibleSolutions.add(i);
		}
	}

	public boolean getIsSolved() {
		return isSolved;
	}

	public int getAnswer() {
		return answer;
	}

	public int getIndex() {
		return index;
	}

	public boolean setAnswer(int answer) {
		if (!possibleSolutions.contains(answer)) {
			System.err.println("DOES NOT CONTAIN ANSWER!!!");
			return false;
		}
		this.answer = answer;
		isSolved = true;
		possibleSolutions.clear();
		return true;

	}

	// TODO: USED THIS!!!!
	public void excludeSolution(int toExclude) {

		int tempIndex = this.possibleSolutions.indexOf(toExclude);
		if (tempIndex >= 0) {
			this.possibleSolutions.remove(tempIndex);
			Puzzle.changed = true;
		}
		if (this.possibleSolutions.size() == 1) {
			setAnswer(this.possibleSolutions.get(0));
		}

	}

	public ArrayList<Integer> getPossibleSolutions() {
		return possibleSolutions;
	}

	public Cell(int index, int ans) {
		this(index);

		// If it is already filled in, there are no possible solutions and the
		// answer is ans
		if (ans != 46) {
			this.index = index;

			this.setAnswer(ans - 48);
		}

	}

	public static int getRow(int index) {
		int row = index / 9;
		return row;
	}

	public static int getColumn(int index) {
		int column = index % 9;
		return column;
	}

	public static int getSquare(int index) {
		int row = getRow(index);
		int column = getColumn(index);
		int square = (column / 3);
		square *= 3;
		square += (row / 3);
		return square;
	}

	public String getPossibleStuff(Puzzle puzzle) {
		int row = getRow(index);
		int column = getColumn(index);
		int square = getSquare(index);
		String s = "(" + row + "," + column + "," + square + ")\t";
		for (Integer sol : possibleSolutions) {
			s += sol + " ";
		}
		if (possibleSolutions.isEmpty()) {
			s += "ERROR!!!!";
		}
		return s;
	}

	public boolean basicUpdate(Puzzle puzzle) {

		if (this.isSolved) {
			// System.out.println("SOLVED????");
			return true;
		}

		int row = getRow(index);
		int column = getColumn(index);
		int square = getSquare(index);

		// for each cell in the same row
		for (int i = 0; i < 9; i++) {
			if (puzzle.cells[row][i].isSolved) {
				if (this.possibleSolutions
						.contains(puzzle.cells[row][i].answer)) {
					int tempIndex = this.possibleSolutions
							.indexOf(puzzle.cells[row][i].answer);
					this.possibleSolutions.remove(tempIndex);
					Puzzle.changed = true;
				}
			}
		}

		// for each cell in the same column
		for (int i = 0; i < 9; i++) {
			if (puzzle.cells[i][column].isSolved) {
				if (this.possibleSolutions
						.contains(puzzle.cells[i][column].answer)) {
					int tempIndex = this.possibleSolutions
							.indexOf(puzzle.cells[i][column].answer);
					this.possibleSolutions.remove(tempIndex);
					Puzzle.changed = true;
				}
			}
		}

		// for each cell in the same square
		for (int i = 0; i < 81; i++) {
			if (getSquare(i) == square) {
				int tempRow = getRow(i);
				int tempColumn = getColumn(i);
				if (puzzle.cells[tempRow][tempColumn].isSolved) {
					if (this.possibleSolutions
							.contains(puzzle.cells[tempRow][tempColumn].answer)) {
						int tempIndex = this.possibleSolutions
								.indexOf(puzzle.cells[tempRow][tempColumn].answer);
						this.possibleSolutions.remove(tempIndex);
						Puzzle.changed = true;
					}
				}

			}
		}

		if (possibleSolutions.size() == 1) {
			this.answer = possibleSolutions.get(0);
			possibleSolutions.clear();
			this.isSolved = true;
		}

		return possibleSolutions.isEmpty();

	}

	public boolean update(Puzzle puzzle) {

		basicUpdate(puzzle);
		rowOverlap(puzzle);
		basicUpdate(puzzle);
		columnOverlap(puzzle);
		basicUpdate(puzzle);
		squareOverlap(puzzle);
		basicUpdate(puzzle);
		combinedOverlap(puzzle);

		return isSolved;

	}

	private boolean combinedOverlap(Puzzle puzzle) {
		if (this.isSolved) {
			return true;
		}

		int row = getRow(index);
		int column = getColumn(index);
		int square = getSquare(index);
		Cell other;

		ArrayList<Integer> uniquePossibleSolutions = new ArrayList<Integer>();

		for (Integer sol : possibleSolutions) {
			uniquePossibleSolutions.add(sol);
		}

		// for each cell in the same column
		for (int i = 0; i < 9; i++) {
			if (i == row) {
				continue;
			}
			other = puzzle.cells[i][column];

			if (!other.isSolved) {
				for (Integer sol : other.possibleSolutions) {
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
			other = puzzle.cells[row][i];
			if (!other.isSolved) {
				for (Integer sol : other.possibleSolutions) {
					int tempIndex = uniquePossibleSolutions.indexOf(sol);
					if (tempIndex >= 0) {
						uniquePossibleSolutions.remove(tempIndex);
					}
				}

			}
		}

		// for each cell in the same square
		for (int i = 0; i < 81; i++) {
			if (getSquare(i) == square) {
				int tempRow = getRow(i);
				int tempColumn = getColumn(i);
				if (tempRow == row && tempColumn == column) {
					continue;
				}
				other = puzzle.cells[tempRow][tempColumn];

				if (!other.isSolved) {
					for (Integer sol : other.possibleSolutions) {
						int tempIndex = uniquePossibleSolutions.indexOf(sol);
						if (tempIndex >= 0) {
							uniquePossibleSolutions.remove(tempIndex);
						}
					}
				}
			}
		}

		if (uniquePossibleSolutions.size() == 1) {
			Puzzle.changed = true;
			this.answer = uniquePossibleSolutions.get(0);
			possibleSolutions.clear();
			this.isSolved = true;
		}
		return possibleSolutions.isEmpty();

	}

	private boolean columnOverlap(Puzzle puzzle) {
		if (this.isSolved) {
			return true;
		}

		int row = getRow(index);
		int column = getColumn(index);
		// int square = getSquare(index);
		Cell other;

		ArrayList<Integer> uniquePossibleSolutions = new ArrayList<Integer>();

		for (Integer sol : possibleSolutions) {
			uniquePossibleSolutions.add(sol);
		}

		// for each cell in the same column
		for (int i = 0; i < 9; i++) {
			if (i == row) {
				continue;
			}
			other = puzzle.cells[i][column];

			if (!other.isSolved) {
				for (Integer sol : other.possibleSolutions) {
					int tempIndex = uniquePossibleSolutions.indexOf(sol);
					if (tempIndex >= 0) {
						uniquePossibleSolutions.remove(tempIndex);
					}
				}

			}

		}

		if (uniquePossibleSolutions.size() == 1) {
			Puzzle.changed = true;
			this.answer = uniquePossibleSolutions.get(0);
			possibleSolutions.clear();
			this.isSolved = true;
		}
		return possibleSolutions.isEmpty();
	}

	private boolean rowOverlap(Puzzle puzzle) {
		if (this.isSolved) {
			return true;
		}

		int row = getRow(index);
		int column = getColumn(index);
		// int square = getSquare(index);
		Cell other;
		ArrayList<Integer> uniquePossibleSolutions = new ArrayList<Integer>();

		for (Integer sol : possibleSolutions) {
			uniquePossibleSolutions.add(sol);
		}

		// for each cell in the same row
		for (int i = 0; i < 9; i++) {
			// if the other cell is not solved, compare the possible solutions
			if (i == column) {
				continue;
			}
			other = puzzle.cells[row][i];
			if (!other.isSolved) {

				for (Integer sol : other.possibleSolutions) {
					int tempIndex = uniquePossibleSolutions.indexOf(sol);

					if (tempIndex >= 0) {

						uniquePossibleSolutions.remove(tempIndex);

					}
				}

			}
		}

		if (uniquePossibleSolutions.size() == 1) {
			Puzzle.changed = true;
			this.answer = uniquePossibleSolutions.get(0);
			possibleSolutions.clear();
			this.isSolved = true;
		}
		return possibleSolutions.isEmpty();
	}

	private boolean squareOverlap(Puzzle puzzle) {
		if (this.isSolved) {
			return true;
		}

		int row = getRow(index);
		int column = getColumn(index);
		int square = getSquare(index);
		Cell other;
		ArrayList<Integer> uniquePossibleSolutions = new ArrayList<Integer>();

		for (Integer sol : possibleSolutions) {
			uniquePossibleSolutions.add(sol);
		}
		// for each cell in the same square
		for (int i = 0; i < 81; i++) {
			if (getSquare(i) == square) {
				int tempRow = getRow(i);
				int tempColumn = getColumn(i);
				if (tempRow == row && tempColumn == column) {
					continue;
				}
				other = puzzle.cells[tempRow][tempColumn];

				if (!other.isSolved) {
					for (Integer sol : other.possibleSolutions) {
						int tempIndex = uniquePossibleSolutions.indexOf(sol);
						if (tempIndex >= 0) {
							uniquePossibleSolutions.remove(tempIndex);
						}
					}
				}
			}
		}

		if (uniquePossibleSolutions.size() == 1) {
			Puzzle.changed = true;
			this.answer = uniquePossibleSolutions.get(0);
			possibleSolutions.clear();
			this.isSolved = true;
		}
		return possibleSolutions.isEmpty();
	}

	@Override
	public String toString() {
		String s = "";
		if (isSolved) {
			s += answer;
		} else {
			s += "*";
		}
		return s;
	}

}
