#install required libraries for PyPDF2
#pip install PyPDF2
#python -m pip install --upgrade pip

import PyPDF2 as p2

file = open("autodesk1.pdf","rb")
#x = p2.PdfFileReader(file)
x = sys.argv[1]
#remove header
##for i in range(0,x.numPages):
##    print(x.getPage(i).extractText().strip("\n"))

#Install Natual Language Library
#pip3 install nltk
import nltk
#nltk.download()
#tokenize
from nltk.tokenize import sent_tokenize, word_tokenize
example_text = "Hello there, how are you doing today? the weather is great and python is awesome. The sky is pinkish-blue. You should not eat cardboard."
##print(sent_tokenize(example_text))
##print(word_tokenize(example_text))
##for i in range(0,x.numPages):
##    for j in sent_tokenize(x.getPage(i).extractText().strip("\n")):
##        print(x.getPage(i).extractText().strip("\n"))
fsent = ""
def filterWords(sentence):
    fsent = ""
    fWords = [] 
    from nltk.corpus import stopwords
    from nltk.tokenize import word_tokenize
    stop_words = set(stopwords.words("english"))
    words = word_tokenize(sentence)
    for w in words:
        if w not in stop_words:
            fWords.append(w)
            if len(fsent)== 0:
                fsent = str(w)
            else:
                fsent = fsent + " " + str(w)
    return fWords
        
    
for j in sent_tokenize(x.getPage(0).extractText().strip("\n")):
    print(filterWords(j))
