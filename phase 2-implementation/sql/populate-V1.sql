INSERT INTO course (shortName,discription,educator_answerID) VALUES ('Advanced Operating Systems','6210',1);
INSERT INTO course (shortName,discription,educator_answerID) VALUES ('Computer Networks','6250',1);
INSERT INTO course (shortName,discription,educator_answerID) VALUES ('Software Development Process','6300',1);
INSERT INTO course (shortName,discription,educator_answerID) VALUES ('Machine Learning','7641',1);
INSERT INTO course (shortName,discription,educator_answerID) VALUES ('High Performance Computer Architecture','6290',1);
INSERT INTO course (shortName,discription,educator_answerID) VALUES ('Software Architecture and Design','6310',1);
INSERT INTO course (shortName,discription,educator_answerID) VALUES ('Intro to Health Informatics','6440',1);
INSERT INTO course (shortName,discription,educator_answerID) VALUES ('Computability, Complexity and Algorithms','6505',1);
INSERT INTO course (shortName,discription,educator_answerID) VALUES ('Knowledge-Based Artificial Intelligence, Cognitive Systems','7637',1);
INSERT INTO course (answerID,name,number,avail_fall,avail_spring,avail_summer) VALUES (10,'Computer Vision','4495',0,1,0);
INSERT INTO course (answerID,name,number,avail_fall,avail_spring,avail_summer) VALUES (11,'Computational Photography','6475',1,0,0);
INSERT INTO course (answerID,name,number,avail_fall,avail_spring,avail_summer) VALUES (12,'Introduction to Operating Systems','8803-002',1,1,1);
INSERT INTO course (answerID,name,number,avail_fall,avail_spring,avail_summer) VALUES (13,'Artificial Intelligence for Robotics','8803-001',1,1,1);
INSERT INTO course (answerID,name,number,avail_fall,avail_spring,avail_summer) VALUES (14,'Introduction to Information Security','6035',0,1,0);
INSERT INTO course (answerID,name,number,avail_fall,avail_spring,avail_summer) VALUES (15,'High-Performance Computing','6220',1,0,0);
INSERT INTO course (answerID,name,number,avail_fall,avail_spring,avail_summer) VALUES (16,'Machine Learning for Trading','7646',0,1,0);
INSERT INTO course (answerID,name,number,avail_fall,avail_spring,avail_summer) VALUES (17,'Special Topics: Reinforcement Learning','8803',1,0,0);
INSERT INTO course (answerID,name,number,avail_fall,avail_spring,avail_summer) VALUES (18,'Special Topics: Big Data','8803',0,1,0);


INSERT INTO Educator (first_name,last_name,user_name,password) VALUES ('AUDREY','BERGER','ABERGE1',MD5('password'));
INSERT INTO Educator (first_name,last_name,user_name,password) VALUES ('ROBERT','ORTIZ','RORTIZ1',MD5('password'));
INSERT INTO `educator` (`educator_answerID`, `user_name`, `password`, `first_name`, `last_name`) VALUES ('3', 'MartinL', 'md5(\'password\')', 'Martin', 'Lorry');
INSERT INTO Student (first_name,last_name,user_name,password) VALUES ('CLARENCE','MILLS','CMILLS1',MD5('password'));
INSERT INTO Student (first_name,last_name,user_name,password) VALUES ('CYNTHIA','BARKER','CBARKE1',MD5('password'));
INSERT INTO Student (first_name,last_name,user_name,password) VALUES ('GERTRUDE','KING','GKING1',MD5('password'));
INSERT INTO Student (first_name,last_name,user_name,password) VALUES ('ROBERT','CALDWELL','RCALDW1',MD5('password'));
INSERT INTO Student (first_name,last_name,user_name,password) VALUES ('WILLIAM','JOHNSON','WJOHNS1',MD5('password'));
INSERT INTO Student (first_name,last_name,user_name,password) VALUES ('CATHY','SMITH','CSMITH1',MD5('password'));
INSERT INTO Student (first_name,last_name,user_name,password) VALUES ('KENNETH','DUNCAN','KDUNCA1',MD5('password'));
INSERT INTO Student (first_name,last_name,user_name,password) VALUES ('KATHERINE','ARMSTRONG','KARMST1',MD5('password'));
INSERT INTO Student (first_name,last_name,user_name,password) VALUES ('ANDREW','BAILEY','ABAILE1',MD5('password'));

INSERT INTO `keyconcept`(`keyID`, `courseID`, `name`) VALUES ('1','1','operating system')
INSERT INTO `keyconcept`(`keyID`, `courseID`, `name`) VALUES ('2','9','knowledge base')
INSERT INTO `keyconcept`(`keyID`, `courseID`, `name`) VALUES ('3','9','binary search')
INSERT INTO `keyconcept`(`keyID`, `courseID`, `name`) VALUES ('4','9','network')
INSERT INTO `keyconcept`(`keyID`, `courseID`, `name`) VALUES ('5','9','cognitive')

INSERT INTO `quiz` (`quizID`, `courseID`, `score`, `title`) VALUES ('1', '2', '0', 'Quiz_1');
INSERT INTO `quiz` (`quizID`, `courseID`, `score`, `title`) VALUES ('2', '1', '0', 'Quiz_2');


INSERT INTO `question` (`questionID`, `questionText`, `answer`, `quizID`, `keyID`) VALUES ('1', 
'What is the term used for describing the judgmental or commonsense part of problem solving?', 
'A', '1', '1');

INSERT INTO `answer` (`answerID`, `questionID`, `text`) VALUES ('A', '1', 'Heuristic');
INSERT INTO `answer` (`answerID`, `questionID`, `text`) VALUES ('B', '1', 'Critical');
INSERT INTO `answer` (`answerID`, `questionID`, `text`) VALUES ('C', '1', 'Value based');
INSERT INTO `answer` (`answerID`, `questionID`, `text`) VALUES ('D', '1', 'Analytical');

INSERT INTO `question` (`questionID`, `questionText`, `answer`, `quizID`, `keyID`) VALUES ('2', 
'A.M. turing developed a technique for determining whether a computer could or could not demonstrate the artificial Intelligence,this technique is called'
, 'A', '1', '1');

INSERT INTO `answer` (`answerID`, `questionID`, `text`) VALUES ('A', '2', 'Turing Test');
INSERT INTO `answer` (`answerID`, `questionID`, `text`) VALUES ('B', '2', 'Algorithm');
INSERT INTO `answer` (`answerID`, `questionID`, `text`) VALUES ('C', '2', 'Boolean Algebra');
INSERT INTO `answer` (`answerID`, `questionID`, `text`) VALUES ('D', '2', 'ogarithm');

INSERT INTO `question` (`questionID`, `questionText`, `answer`, `quizID`, `keyID`) VALUES ('3', 
'
A Personal Consultant knowledge base contain information in the form of:', 
'D', '1', '1');

INSERT INTO `answer` (`answerID`, `questionID`, `text`) VALUES ('A', '3', 'parameters');
INSERT INTO `answer` (`answerID`, `questionID`, `text`) VALUES ('B', '3', 'contexts');
INSERT INTO `answer` (`answerID`, `questionID`, `text`) VALUES ('C', '3', 'production rules');
INSERT INTO `answer` (`answerID`, `questionID`, `text`) VALUES ('D', '3', 'all of above');


INSERT INTO `question` (`questionID`, `questionText`, `answer`, `quizID`, `keyID`) VALUES ('4', 
'
Which approach to speech recognition avoanswerIDs the problem caused by the variation in speech patterns among different speakers?', 
'D', '1', '1');

INSERT INTO `answer` (`answerID`, `questionID`, `text`) VALUES ('A', '4', 'Continuous speech recognition');
INSERT INTO `answer` (`answerID`, `questionID`, `text`) VALUES ('B', '4', 'Isolated word recognition');
INSERT INTO `answer` (`answerID`, `questionID`, `text`) VALUES ('C', '4', 'Connected word recognition');
INSERT INTO `answer` (`answerID`, `questionID`, `text`) VALUES ('D', '4', 'Speaker-dependent recognition');


INSERT INTO `question` (`questionID`, `questionText`, `answer`, `quizID`, `keyID`) VALUES ('5', 
'Which of the following, is a component of an expert system?',
'D', '1', '1');

INSERT INTO `answer` (`answerID`, `questionID`, `text`) VALUES ('A', '5', 'inference engine');
INSERT INTO `answer` (`answerID`, `questionID`, `text`) VALUES ('B', '5', 'knowledge base');
INSERT INTO `answer` (`answerID`, `questionID`, `text`) VALUES ('C', '5', 'user interface');
INSERT INTO `answer` (`answerID`, `questionID`, `text`) VALUES ('D', '5', 'all of the above');

INSERT INTO `question` (`questionID`, `questionText`, `answer`, `quizID`, `keyID`) VALUES ('6', 
'Data security threats include',
'B', '1', '2');

INSERT INTO `answer` (`answerID`, `questionID`, `text`) VALUES ('A', '6', 'hardware failure');
INSERT INTO `answer` (`answerID`, `questionID`, `text`) VALUES ('B', '6', 'privacy invasion');
INSERT INTO `answer` (`answerID`, `questionID`, `text`) VALUES ('C', '6', 'fraudulent manipulation of data');
INSERT INTO `answer` (`answerID`, `questionID`, `text`) VALUES ('D', '6', 'all of the above');

INSERT INTO `question` (`questionID`, `questionText`, `answer`, `quizID`, `keyID`) VALUES ('7', 
'In SQL, which command is used to add a column/integrity constraint to a table',
'D', '1', '2');

INSERT INTO `answer` (`answerID`, `questionID`, `text`) VALUES ('A', '7', 'add column');
INSERT INTO `answer` (`answerID`, `questionID`, `text`) VALUES ('B', '7', 'insert column');
INSERT INTO `answer` (`answerID`, `questionID`, `text`) VALUES ('C', '7', 'modify table');
INSERT INTO `answer` (`answerID`, `questionID`, `text`) VALUES ('D', '7', 'alter table');


INSERT INTO `question` (`questionID`, `questionText`, `answer`, `quizID`, `keyID`) VALUES ('8', 
'In a relational schema, each tuple is divanswerIDed into fields called',
'A', '1', '3');

INSERT INTO `answer` (`answerID`, `questionID`, `text`) VALUES ('A', '8', 'relations');
INSERT INTO `answer` (`answerID`, `questionID`, `text`) VALUES ('B', '8', 'domains');
INSERT INTO `answer` (`answerID`, `questionID`, `text`) VALUES ('C', '8', 'queries');
INSERT INTO `answer` (`answerID`, `questionID`, `text`) VALUES ('D', '8', 'all of above');

INSERT INTO `question` (`questionID`, `questionText`, `answer`, `quizID`, `keyID`) VALUES ('9', 
'In a relational schema, each tuple is divanswerIDed into fields called',
'A', '1', '3');

INSERT INTO `answer` (`answerID`, `questionID`, `text`) VALUES ('A', '9', 'update');
INSERT INTO `answer` (`answerID`, `questionID`, `text`) VALUES ('B', '9', 'insert');
INSERT INTO `answer` (`answerID`, `questionID`, `text`) VALUES ('C', '9', 'browse');
INSERT INTO `answer` (`answerID`, `questionID`, `text`) VALUES ('D', '9', 'append');

INSERT INTO `question` (`questionID`, `questionText`, `answer`, `quizID`, `keyID`) VALUES ('10', 
'Which command(s) is(are) used to redefine a column of the table in SQL ?',
'A', '1', '3');

INSERT INTO `answer` (`answerID`, `questionID`, `text`) VALUES ('A', '10', 'alter table');
INSERT INTO `answer` (`answerID`, `questionID`, `text`) VALUES ('B', '10', 'define table');
INSERT INTO `answer` (`answerID`, `questionID`, `text`) VALUES ('C', '10', 'modify table');
INSERT INTO `answer` (`answerID`, `questionID`, `text`) VALUES ('D', '10', 'all of above');

INSERT INTO `usagelog` (`logID`, `questionID`, `stuID`, `date`) VALUES ('1', '3', '1', '2017-03-01 00:00:00');
INSERT INTO `usagelog` (`logID`, `questionID`, `stuID`, `date`) VALUES ('2', '2', '1', '2017-03-02 00:00:00');
INSERT INTO `usagelog` (`logID`, `questionID`, `stuID`, `date`) VALUES ('3', '9', '1', '2017-03-03 00:00:00');

