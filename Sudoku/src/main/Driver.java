package main;

import java.io.IOException;
import java.nio.charset.Charset;
import java.nio.file.Files;
import java.nio.file.Paths;

import datastructures.Puzzle;

public class Driver {

	public static void main(String[] args) {
		// TODO Auto-generated method stub
		String path = "./Puzzles/P1.txt";
		String input = null;
		try {
			input =readFile(path,Charset.forName("UTF-8"));
		} catch (IOException e) {
			// TODO Auto-generated catch block
			e.printStackTrace();
		}
		Puzzle puzzle = new Puzzle(input.substring(0, 81));
		
		System.out.println(puzzle);
		System.out.println("Originally solved: " + puzzle.getNumberSolved());
		
		puzzle.solve();
		System.out.println("**********************************");
		System.out.println(puzzle);
		System.out.println("Solved: " + puzzle.getNumberSolved());
		
		

	}
	
	
	static String readFile(String path, Charset encoding) 
			  throws IOException 
			{
			  byte[] encoded = Files.readAllBytes(Paths.get(path));
			  return new String(encoded, encoding);
			}

}
