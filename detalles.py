import os
import sys
import fileinput
import shutil
from os import path

if len(sys.argv) == 3:
    midato = sys.argv[1]
    pathpos = sys.argv[2]

    commando = 'python cbia_zona221y22.py ' + ' ' +midato + ' ' + '"'+ pathpos + '"'
   
    os.system(commando)
    # print (commando+" - "+midato)
    
else:
    print ("nada llego a detalles")