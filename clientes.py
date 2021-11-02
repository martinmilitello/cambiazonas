import os
import sys
import fileinput
import shutil
from os import path

if len(sys.argv) == 3:
    midato = sys.argv[1]
    pathcli = sys.argv[2]

    commando = 'python cliente_cbia_zona221y22.py ' + ' ' +midato + ' ' + '"'+ pathcli + '"'
    os.system(commando)
    # print (commando+" - "+midato)
    
else:
    print ("nada llego a clientes")