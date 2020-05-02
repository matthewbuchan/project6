import django_filters

from .models import Certificate

class CertificateFilter(django_filters.FilterSet):

    class Meta:

        model = Certificate
        fields = {
            'id': ['icontains'], 
            # 'userid',
            # 'reportnumber',
            # 'issuedate',
            # 'standardid',
            # 'locationid',
            # 'modelnumber' 
        }
