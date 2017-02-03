@echo on
cls
cd %~dp0\codejudge-compiler\src\codejudge\compiler
javac CodejudgeCompiler.java RequestThread.java TimedShell.java languages/Language.java languages/C.java languages/Cpp.java languages/Java.java languages/Python.java
java CodejudgeCompiler





