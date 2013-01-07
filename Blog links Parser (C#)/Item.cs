using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace SeoParser
{
    class Item
    {
        public string Url { get; set; }
        public string Filename { get; set; }

        public IStrategy Strategy { get; set; }

        public Item(string url, string filename, IStrategy strategy)
        {
            Url = url;
            Filename = filename;
            Strategy = strategy;
        }
    }
}
