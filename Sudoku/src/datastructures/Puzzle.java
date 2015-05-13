package datastructures;

public class Puzzle {
	public Cell[][] cells = new Cell[9][9];
	public static boolean changed = false;

	public Puzzle(String input) {
		for (int i = 0; i < 81; i++) {
			cells[i / 9][i % 9] = new Cell(i, input.charAt(i));
		}
	}

	public void printPossibleStuff() {
		for (int i = 0; i < 81; i++) {

			System.out.println(cells[i / 9][i % 9].getPossibleStuff(this));
		}
	}

	public void solve() {

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

		update();

		System.err.println("SOLVED? " + puzzleSolved + "(loops:" + loops + ")");

	}

	private boolean update() {
		boolean puzzleSolved = true;

		for (int i = 0; i < 81; i++) {
			int row = i / 9;
			int column = i % 9;
			boolean temp = this.cells[row][column].basicUpdate(this);
			puzzleSolved = puzzleSolved && temp;
		}
		return puzzleSolved;
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

}
