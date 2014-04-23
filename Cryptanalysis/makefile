#Elliott Tanner
#Cryptanalysis makefile
#
#

CPP = /usr/bin/g++
OBJ_FILES = /bin/*.o
HEADER_FILES = /src/*.h

Solve : $(OBJ_FILES) $(HEADER_FILES)
	$(CPP) -o $@ $^

bin/%.o : src/%.cpp
	$(CPP) -c $<


compile : Solve

run : Solve
	./Solve



clean:
	-rm $(OBJ_FILES)
	-rm Solve
	-rm ./*~
	-rm ./*/*~