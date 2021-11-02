# Nombre del Programa: separar221.py
# Funcion:  Invocado desde PHP, recibe fecha y hora, arma nombres y llama 3 veces a otros .py
#           
# Ejemplo: python separar221.py 'PSTD20210325cabecera' 'clorinda'
# Creación : OB - 11/05/2021 - 
# Modificaciones : 
# 

import os
import sys
import fileinput
import shutil
from os import path
 
#Nota: demapas.txt: concatenar los codigos provistos de varias zonas

if len(sys.argv) == 5:
    mifecha = sys.argv[1] # Archivo a ser reemplazado (PSTD_CabeceraSAP)
    mihora  = sys.argv[2] # Archivo a ser reemplazado (PSTD_CabeceraSAP)
    mipathcli = sys.argv[3] # "//dc10004/InterfacesSAP/VENTASCLI/BACKUP/"
    mipathpos = sys.argv[4] # "//dc10004/InterfacesSAP/INTPEDIDOS/BACKUP/"

    lalon1=len(mifecha)
    lalon2=len(mihora)

     
    if lalon1==8 and lalon2==6:
       #  print ("mifecha "+mifecha+" mihora "+mihora)
        
        cabeza="PSTD"+mifecha+"_"+mihora+"Cabecera"
        detalle="PSTD"+mifecha+"_"+mihora+"posiciones"
        cliente="Cli_fact_"+mifecha
        #------------------------------#
        counter=0
        acorrer={"cabeceras.py":cabeza,"detalles.py":detalle,"clientes.py":cliente}
        for miprog, minom in acorrer.items():
            if miprog == 'clientes.py' and os.path.isfile(mipathcli+minom+'.txt') :
                commando = 'python ' + miprog + ' ' +minom + '  ' + '"'+ mipathcli + '"'
                os.system(commando)
                counter += 1
          
                
            if miprog == 'cabeceras.py' and os.path.isfile(mipathpos+minom+'.txt') :
                commando = 'python ' + miprog + ' ' +minom + '  ' + '"'+ mipathpos + '"'
                os.system(commando)
                counter += 1
          
            if miprog == 'detalles.py' and os.path.isfile(mipathpos+minom+'.txt'):
                commando = 'python ' + miprog + ' ' +minom + '  ' + '"'+ mipathpos + '"'
                os.system(commando)
                counter += 1
        
        if counter != 3:
            print("Problemas con alguno de los archivos, revise las rutas y nombres." )

    else:
        print ("Fecha distinta a 8 caracteres u hora distinta a 6 caracteres")
else :
    print ("Ejecutado sin argumentos")

# python separar221 "20210508" "030512"    