from rest_framework import serializers
from .models import Product
from .models import Certificate
from .models import Service

class ProductSerializer(serializers.ModelSerializer):

    class Meta:
        model = Product
        fields = ['modelnumber', 'productname', 'celltechnology', 'numberofcells','numberofcellsinseries','numberofseriesinstrings','numberofdiodes','productlength','productwidth','productweight','superstatetype','superstatemanufacturer','substratetype','substratemanufacturer','frametype','frameadhesive','encapsulatetype','encapsulatemanufacturer','junctionboxtype','junctionboxmanufacturer']
    
class CertificateSerializer(serializers.ModelSerializer):

    class Meta:
        model = Certificate
        fields = ['userid','reportnumber','issuedate','standardid','locationid','modelnumber']

class ServiceSerializer(serializers.ModelSerializer):

    class Meta:
        model = Service
        fields = ['servicename','description','isfirequired','fifrequency','standardid']
