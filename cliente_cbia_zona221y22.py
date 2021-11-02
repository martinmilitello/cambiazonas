# Nombre del Programa: cbia_zona221y22.py
# Funcion:  Para cada revendedora contenida en un archivo TXT provisto por Mapas,
#           Se le cambiará la zona especificada en el Archivo TXT "qzobuscar.txt"
# Ejemplo: python cbia_zona221y22.py 'PSTD20210325cabecera' 'clorinda'
# Creación : OB - 05/04/2021 - 
# Modificaciones : 09/04/2021: MM - Se agregan los parámetros de nombres de archivo
# 

import os
import sys
import fileinput
import shutil
from os import path
#print ("demapas.txt: concatenar los codigos provistos de varias zonas")

if len(sys.argv) == 3:
    entra = sys.argv[1] # Archivo a ser reemplazado (PSTD_CabeceraSAP)
    pathcli = sys.argv[2]  # "//dc10004/InterfacesSAP/VENTASCLI/BACKUP/"


    fnameMap = "demapas" # Archivo Provisto por Gustavo Ramirez 


    #----------------------------- # cabecera de salida
    fnameBus = "subidas/qzobuscar.txt"
    fbus= open(fnameBus, encoding="utf-8")
    counter = 0
    dicBus = dict()
    #------------------------------# abrio pares a buscar
    # fnameMap = "demapas"   #input("Archivo de mapas: ")
    fmapas= open('subidas/'+fnameMap+'.txt', encoding="utf-8")

    
    # pathcli = "//dc10004/InterfacesSAP/VENTASCLI/"  # REEMPLAZAR PARAPRODUCTIVO
    
    fnameOut = pathcli + entra + ".txt"

    

    back_path = pathcli + 'ClienteOriginal.txt'
    if path.exists(back_path):
        try:
            os.remove(back_path)
        except OSError as e:
            print("Error: %s : %s" % (back_path, e.strerror))

    os.rename(fnameOut, pathcli + "ClienteOriginal.txt")
    #----------------------------- 
    fOut = open(fnameOut,"w", encoding="utf-8")
    #----------------------------- 
    fnameBus = "subidas/qzobuscar.txt"
    fbus= open(fnameBus, encoding="utf-8")
    counter = 0
    dicBus = dict()
    for lineB in fbus:
        wordsB = lineB.rstrip().split()
        for wordB in wordsB:
            dicBus[wordB] = counter
            counter += 1
    fbus.close()
    #------------------------------# abrio pares a buscar
    #fnameMap = "demapas"   #input("Archivo de mapas: ")
    fmapas= open('subidas/'+fnameMap+'.txt',encoding="utf-8")
    counter = 0
    dicMapas = dict()
    for lineM in fmapas:
        wordsM = lineM.rstrip().split()
        for wordM in wordsM:
            dicMapas[wordM] = counter
            counter += 1
    topeM = counter
    #----------------------------# abrio codigos a buscar
    fname = pathcli + "ClienteOriginal.txt"      #input("Archivo de Cabecera: ")    # "PSTD20210325cabecera.txt"
    f = open(fname, "r+",encoding="utf8")

    for pzon in dicBus.items():
    #for pzon in fbus:
        f.close()
        ladupla=pzon[0]
        trozito=ladupla.split(';')
        leozo=trozito[0]
        ponezo=trozito[1]
    
        # f = open(fname, "rb+")  
        f = open(fname, "r+", encoding="utf-8")
        

        for line in fileinput.input( fname , openhook=fileinput.hook_encoded("utf-8")):
             pedazos=line.split(';')
             # y = x.replace("Hello", "\nHey\n").lstrip("\n").split("\n") 
             
            # .replace(buscar, reemplazar_por)
             zonasec=pedazos[3]
             zona=zonasec[0:3]
             secc=zonasec[3:6]
             mina=pedazos[0]
             #---------------
             if zona==leozo:
                 habia=0
                 for w, z in dicMapas.items():
                     if w == mina :
                         habia=1
                 if habia==1:
                    fOut.write( line.replace(zonasec, ponezo+secc) )
                
                 else:
                    fOut.write(line)
                 fOut.flush()
    for line in fileinput.input( fname , openhook=fileinput.hook_encoded("utf-8")):
        pedazos=line.split(';')
        zonasec=pedazos[3]
        zona=zonasec[0:3]
        habia=0
        for pzon in dicBus.items():
                ladupla=pzon[0]
                trozito=ladupla.split(';')
                leozo=trozito[0]
                if zona==leozo:
                    habia=1
        if habia==0:
                fOut.write( line )
                fOut.flush()

    f.close() 
else:
    print ("Parametros equivocados")

