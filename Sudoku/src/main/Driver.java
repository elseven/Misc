package main;

import java.io.BufferedReader;
import java.io.FileNotFoundException;
import java.io.FileReader;
import java.io.IOException;
import java.io.PrintStream;

import datastructures.Puzzle;

public class Driver {
	public static boolean debug = true;

	public static PrintStream failedPuzzleOut = null;

	public static void main(String[] args) {
		// TODO Auto-generated method stub

		try {
			failedPuzzleOut = new PrintStream("./Puzzles/failed.txt");
		} catch (FileNotFoundException e0) {
			// DO NOTHING
		}

		String path = "./Puzzles/IMPOSSIBLE.txt";

		// errOut.println("START!");
		try (BufferedReader br = new BufferedReader(new FileReader(path))) {
			String puzzleText;
			int totalCount = 0;
			int solvedCount = 0;
			while ((puzzleText = br.readLine()) != null) {
				totalCount++;
				System.out.println("====================================");
				System.out.println("Input Puzzle:\n" + puzzleText);
				Puzzle puzzle = new Puzzle(puzzleText);

				System.out.println(puzzle);
				System.out.println("Number of orginially solved cells: "
						+ puzzle.getNumberSolved());
				System.out.println("====================================");
				if (puzzle.run()) {
					solvedCount++;
				} else {
					failedPuzzleOut.println(puzzleText);
				}
				break;
			}
			System.out
					.println("==============================================================");
			System.out
					.println("==============================================================");
			System.out
					.println("==============================================================");
			System.out.println("TOTAL PUZZLES : \t" + totalCount);
			System.out.println("SOLVED PUZZLES: \t" + solvedCount);
		} catch (FileNotFoundException e) {
			System.err.println("NO SUCH FILE!: " + path);

		} catch (IOException e) {
			System.err.println("CAN'T READ FILE: " + path);
		}

	}
}
