package main;

import java.io.IOException;
import java.io.PrintStream;
import java.nio.charset.Charset;
import java.nio.file.Files;
import java.nio.file.Paths;

import datastructures.Puzzle;

public class Driver {

	private static int puzzleIndex = 2;
	public static PrintStream errOut = null;

	public static void main(String[] args) {
		// TODO Auto-generated method stub
		String outPath = "ErrorOut.txt";

		String path = "./Puzzles/P1.txt";
		String input = null;
		try {
			input = readFile(path, Charset.forName("UTF-8"));
			errOut = new PrintStream(outPath);
			// errOut.
		} catch (IOException e) {
			// TODO Auto-generated catch block
			e.printStackTrace();
		}
		errOut.println("START!");
		/*
		 * int startIndex = 81 * puzzleIndex + puzzleIndex; int endIndex =
		 * startIndex + 81; System.out.println(input.substring(startIndex,
		 * endIndex)); Puzzle puzzle = new Puzzle(input.substring(startIndex,
		 * endIndex));
		 * 
		 * System.out.println(puzzle); System.out.println("Originally solved: "
		 * + puzzle.getNumberSolved()); puzzle.run();
		 */

		for (int i = 2; i < 3; i++) {
			int startIndex = 81 * i + i;
			int endIndex = startIndex + 81;
			System.out.println(input.substring(startIndex, endIndex));
			Puzzle puzzle = new Puzzle(input.substring(startIndex, endIndex));

			System.out.println(puzzle);
			System.out
					.println("Originally solved: " + puzzle.getNumberSolved());
			puzzle.run();
		}

	}

	static String readFile(String path, Charset encoding) throws IOException {
		byte[] encoded = Files.readAllBytes(Paths.get(path));
		return new String(encoded, encoding);
	}

}
