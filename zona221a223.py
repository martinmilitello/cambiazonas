import os
import sys
import fileinput

# os.chdir("/Users/MissOgra/Documents")

if len(sys.argv) == 3:
    archivoreemplazo = sys.argv[1]
    fname = sys.argv[2]

    # archivoreemplazo = 'PSTD20210325cabecera.txt'

    # fname = 'clorinda.txt'
    # if len(fname) < 1 : fname = "words.txt"
    fh= open(fname)
    counter = 0
    revendmapas=dict()
    for listrevend in fh:
        revends = listrevend.rstrip().split()
        for revend in revends:
            revendmapas[revend] = counter
            counter += 1
    fh.close

    for k,v in revendmapas.items():
	    # print ("Clave:",k,"Valor:",v)
        qrevend= k.split(";")
        qrevend=qrevend[0]
      
      #   print(qrevend)
    # for k,v in dicMapas.items():
    #	print ("Clave:",k,"Valor:",v)

    fnameBus = 'qzobuscar.txt'
    fbus= open(fnameBus)
    counter = 0
    dicBus = dict()
    for lineB in fbus:
        wordsB = lineB.rstrip().split()
        for wordB in wordsB:
            dicBus[wordB] = counter
            counter += 1
    fbus.close()

    cuentarev=0
    cuentareemplazos=0
    ## Bloque principal del programa
    for mirev,z in revendmapas.items():
        cuentarev+=1
        qrevend= mirev.split(";")
        buscorev=qrevend[0]
        for k,v in dicBus.items():
	        # print ("Clave:",k,"Valor:",v)
            zonas= k.split(";")
            qbusco=zonas[0]
            qreemplazo=zonas[1]
      
            for line in fileinput.input(archivoreemplazo,inplace=True, backup ='.bak'): 
                sec=line[3:6]
                zonasec=qbusco+sec
                zonasecreemp=qreemplazo+sec

                if buscorev in line :
                    # print ('Encontre la REvendedora!!!!')
                    if zonasec in line:
                        # print('Encontre la Zona!')
                        cuentareemplazos+=1
                        print(line.replace(zonasec,zonasecreemp),end='')
                    else:
                        print(line, end='')
                else:
                    print(line, end='')
        # print(qbusco,qreemplazo )
    print("Se han procesado  : "+str(cuentarev)+" revendedoras.")
    print("Se han reemplazado: "+str(cuentareemplazos)+" revendedoras.")
    
else:
    print ("No tiene los parámetrso requeridos")
