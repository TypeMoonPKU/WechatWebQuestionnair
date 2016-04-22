use typemoon01;     # 还需要在数据库中给这个用户分配权限，还是因为对mysql的权限管理没有系统的了解
CREATE TABLE teacherTable
(
  teacherName VARCHAR(20) NOT NULL ,
  teacherOpenID VARCHAR(20) NOT NULL ,
  teacherID INT NOT NULL AUTO_INCREMENT,
  teacherPassword VARCHAR(20),
  teacherNickName VARCHAR(20),
  PRIMARY KEY (teacherID)
);

CREATE TABLE parentTable
(
  parentName VARCHAR(20) NOT NULL ,
  parentOpenID VARCHAR(20) NOT NULL ,
  parentID INT NOT NULL AUTO_INCREMENT,
  parentPassword VARCHAR(20),
  parentNickName VARCHAR(20),
  PRIMARY KEY (parentID)
);

CREATE TABLE studentTable
(
  studentName VARCHAR(20) NOT NULL ,
  studentID VARCHAR(20) NOT NULL,
  groupID VARCHAR(10),
  ownerteacherID INT NOT NULL ,
  PRIMARY KEY (studentID),
  FOREIGN KEY (ownerteacherID)
    REFERENCES teacherTable(teacherID)
);

CREATE TABLE parentStudentTable
(
  parentID INT NOT NULL ,
  studentID VARCHAR(20) NOT NULL ,
  relationship VARCHAR(10),
  PRIMARY KEY (parentID,studentID),
  FOREIGN KEY (parentID)
    REFERENCES parentTable(parentID),
  FOREIGN KEY (studentID)
    REFERENCES studentTable(studentID)
);

CREATE TABLE questionnaireTable
(
  questionnaireID INT NOT NULL AUTO_INCREMENT,
  title VARCHAR(50),
  questionnaireDescription VARCHAR(500),
  questionnaireType CHAR(1), #q for questionnaire, n for notification
  createTime TIMESTAMP,
  ownerTeacherID INT,
  groupID INT,
  PRIMARY KEY (questionnaireID),
  FOREIGN KEY (ownerTeacherID)
    REFERENCES teacherTable(teacherID),
  CHECK (questionnaireType='Q' OR questionnaireType='N')
);

CREATE TABLE itemTable
(
  questionID INT NOT NULL AUTO_INCREMENT,
  questionnaireID INT NOT NULL ,
  questionType CHAR(1), #s for single, m for mutiple
  questionDescription VARCHAR(500),
  PRIMARY KEY (questionID,questionnaireID),
  FOREIGN KEY (questionnaireID)
    REFERENCES questionnaireTable(questionnaireID),
  CHECK (questionType = 'S' or questionType='M')
);

CREATE TABLE optionTable
(
  optionID INT NOT NULL AUTO_INCREMENT,
  questionID INT,
  questionnaireID INT,
  optionDescription VARCHAR(100),
  PRIMARY KEY (optionID, questionID, questionnaireID),
  FOREIGN KEY (questionID)
    REFERENCES itemTable(questionID),
  FOREIGN KEY (questionnaireID)
    REFERENCES questionnaireTable(questionnaireID)
);

CREATE TABLE answerTable
(
  questionnaireID INT,
  questionID INT,
  optionID INT,
  parentID INT,
  selected BOOLEAN,
  updateTime TIMESTAMP,
  PRIMARY KEY (questionnaireID, questionID, optionID, parentID),
  FOREIGN KEY (questionnaireID)
    REFERENCES questionnaireTable(questionnaireID),
  FOREIGN KEY (questionID)
    REFERENCES itemTable(questionID),
  FOREIGN KEY (optionID)
    REFERENCES optionTable(optionID),
  FOREIGN KEY (parentID)
    REFERENCES parentTable(parentID)
);

CREATE TABLE accessTable
(
  accessToken VARCHAR(50),
  time TIMESTAMP,
  PRIMARY KEY (accessToken)
);