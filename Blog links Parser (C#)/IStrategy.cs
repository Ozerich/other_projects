using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace SeoParser
{
    interface IStrategy
    {
        List<string> Parse(string url);
    }
}
