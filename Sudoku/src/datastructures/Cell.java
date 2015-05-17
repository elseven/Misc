package datastructures;

import java.util.ArrayList;

import main.Driver;

public class Cell {

	private boolean isSolved = false;
	private int answer = 0;

	private ArrayList<Integer> possibleSolutions = new ArrayList<>(9);
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
			if (Driver.debug) {
				System.err.println("DOES NOT CONTAIN ANSWER!!!");
			}

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

	public void excludePossibleSolution(int ans) {
		int index = this.possibleSolutions.indexOf(ans);
		if (index >= 0) {
			this.possibleSolutions.remove(index);
		}
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
