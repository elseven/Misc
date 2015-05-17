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

	public Cell(int index, int ans) {
		this(index);

		// If it is already filled in, there are no possible solutions and the
		// answer is ans
		if (ans != 46) {
			this.index = index;

			this.setAnswer(ans - 48);
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

	public ArrayList<Integer> getPossibleSolutions() {
		return possibleSolutions;
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

	private void excludePossibleSolution(int ans) {
		int index = this.possibleSolutions.indexOf(ans);
		if (index >= 0) {
			this.possibleSolutions.remove(index);
		}
	}

	private boolean refreshPossibleSolutions(Puzzle puzzle) {

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

		return rowOverlap(puzzle) || columnOverlap(puzzle)
				|| squareOverlap(puzzle) || combinedOverlap(puzzle)
				|| nakedTwins(puzzle);

	}

	private boolean nakedTwins(Puzzle puzzle) {
		return nakedTwinsColumn(puzzle) || nakedTwinsRow(puzzle)
				|| nakedTwinsSquare(puzzle);
	}

	// TODO: IMPL NAKED TWINS
	/*
	 * two squares in the same unit that both have the same two possible digits.
	 * Given {'A5': '26', 'A6':'26', ...}, we can conclude that 2 and 6 must be
	 * in A5 and A6 (although we don't know which is where), and we can
	 * therefore eliminate 2 and 6 from every other square in the A row unit.
	 */
	private boolean nakedTwinsColumn(Puzzle puzzle) {
		if (this.isSolved) {
			return true;
		}
		refreshPossibleSolutions(puzzle);

		int row = getRow(index);
		int column = getColumn(index);

		Cell other;

		if (possibleSolutions.size() == 2) {

			// for each cell in the same column
			for (int i = 0; i < 9; i++) {
				if (i == row) {
					continue;
				}
				other = puzzle.cells[i][column];

				if (!other.getIsSolved() && other.possibleSolutions.size() == 2) {
					if (other.possibleSolutions.containsAll(possibleSolutions)) {
						for (int j = 0; j < 9; j++) {
							if (j == row || j == i) {
								continue;
							}
							Cell temp = puzzle.cells[j][column];
							if (!temp.getIsSolved()) {
								System.err.println("HI COLUMN!");
								temp.excludePossibleSolution(possibleSolutions
										.get(0));
								temp.excludePossibleSolution(possibleSolutions
										.get(1));
							}

						}

					}

				}

			}
		}

		return possibleSolutions.isEmpty();
	}

	private boolean nakedTwinsRow(Puzzle puzzle) {
		if (this.isSolved) {
			return true;
		}
		refreshPossibleSolutions(puzzle);

		int row = getRow(index);
		int column = getColumn(index);

		Cell other;

		if (possibleSolutions.size() == 2) {

			// for each cell in the same column
			for (int i = 0; i < 9; i++) {
				if (i == column) {
					continue;
				}
				other = puzzle.cells[row][i];

				if (!other.getIsSolved() && other.possibleSolutions.size() == 2) {
					if (other.possibleSolutions.containsAll(possibleSolutions)) {
						for (int j = 0; j < 9; j++) {
							if (j == column || j == i) {
								continue;
							}
							Cell temp = puzzle.cells[row][j];
							if (!temp.getIsSolved()) {
								System.err.println("HI ROW!");
								temp.excludePossibleSolution(possibleSolutions
										.get(0));
								temp.excludePossibleSolution(possibleSolutions
										.get(1));
							}

						}

					}

				}

			}
		}

		return possibleSolutions.isEmpty();
	}

	private boolean nakedTwinsSquare(Puzzle puzzle) {
		if (this.isSolved) {
			return true;
		}
		refreshPossibleSolutions(puzzle);

		int square = getSquare(index);
		Cell other;

		if (possibleSolutions.size() == 2) {

			for (int i = 0; i < 81; i++) {
				if (getSquare(i) == square) {
					int otherRow = getRow(i);
					int otherColumn = getColumn(i);

					if (i == index) {
						continue;
					}
					other = puzzle.cells[otherRow][otherColumn];

					if (!other.isSolved && other.possibleSolutions.size() == 2) {
						if (other.possibleSolutions
								.containsAll(possibleSolutions)) {

							for (int j = 0; j < 81; j++) {
								int tempSquare = getSquare(j);
								int tempRow = getRow(j);
								int tempColumn = getColumn(j);
								if (tempSquare != square || j == index
										|| j == i) {
									continue;
								}
								Cell temp = puzzle.cells[tempRow][tempColumn];
								if (!temp.getIsSolved()) {
									System.err.println("HI SQUARE!");
									temp.excludePossibleSolution(possibleSolutions
											.get(0));
									temp.excludePossibleSolution(possibleSolutions
											.get(1));
								}

							}
						}
					}
				}

			}
		}
		return possibleSolutions.isEmpty();
	}

	private boolean combinedOverlap(Puzzle puzzle) {
		if (this.isSolved) {
			return true;
		}
		refreshPossibleSolutions(puzzle);

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

	/**
	 * 
	 * @param puzzle
	 * @return
	 */
	private boolean columnOverlap(Puzzle puzzle) {
		if (this.isSolved) {
			return true;
		}
		refreshPossibleSolutions(puzzle);

		int row = getRow(index);
		int column = getColumn(index);

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
		refreshPossibleSolutions(puzzle);
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
		refreshPossibleSolutions(puzzle);

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
