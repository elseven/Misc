package main;

import java.io.BufferedReader;
import java.io.FileNotFoundException;
import java.io.FileReader;
import java.io.IOException;
import java.io.PrintStream;

import datastructures.Puzzle;

public class Driver {
	public static boolean debug = true;

	public static PrintStream errOut = null;

	public static void main(String[] args) {
		// TODO Auto-generated method stub

		String path = "./Puzzles/P1.txt";

		// errOut.println("START!");
		try (BufferedReader br = new BufferedReader(new FileReader(path))) {
			String puzzleText;
			while ((puzzleText = br.readLine()) != null) {
				System.out.println("====================================");
				System.out.println("Input Puzzle:\n" + puzzleText);
				Puzzle puzzle = new Puzzle(puzzleText);

				System.out.println(puzzle);
				System.out.println("Number of orginially solved cells: "
						+ puzzle.getNumberSolved());
				System.out.println("====================================");
				puzzle.run();
			}
		} catch (FileNotFoundException e) {
			System.err.println("NO SUCH FILE!: " + path);

		} catch (IOException e) {
			System.err.println("CAN'T READ FILE: " + path);
		}

	}

}
